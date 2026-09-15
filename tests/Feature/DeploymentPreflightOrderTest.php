<?php

use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

it('guards active code and public assets until candidate validation passes', function (int $status, int $postflightStatus) {
    $root = sys_get_temp_dir().'/danks-deploy-test-'.bin2hex(random_bytes(8));
    foreach (['app/storage/logs', 'app/bootstrap/cache', 'app/public/build', 'public/build', 'candidate/public/build', 'bin'] as $directory) {
        mkdir($root.'/'.$directory, 0700, true);
    }
    file_put_contents($root.'/app/.env', 'SENTINEL=private-value');
    file_put_contents($root.'/app/bootstrap/cache/config.php', '<?php return ["stale" => true];');
    file_put_contents($root.'/candidate/preflight.php', '<?php // Execution is stubbed; configuration behavior is covered by ProductionPreflightTest.');
    file_put_contents($root.'/candidate/public/build/manifest.json', '{}');
    file_put_contents($root.'/app/public/build/new.txt', 'new');
    file_put_contents($root.'/public/build/old.txt', 'old');
    file_put_contents($root.'/public/robots.txt', 'old robots');
    file_put_contents($root.'/public/sitemap.xml', 'old sitemap');
    file_put_contents($root.'/bin/git', <<<'SH'
#!/bin/bash
set -eu
case "$1" in
fetch) echo fetch >> "$DANKS_TEST_ROOT/trace" ;;
rev-parse) echo aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ;;
archive) tar -C "$DANKS_TEST_ROOT/candidate" -cf - . ;;
reset) echo "reset:$3" >> "$DANKS_TEST_ROOT/trace" ;;
*) exit 90 ;;
esac
SH);
    file_put_contents($root.'/bin/php', <<<'SH'
#!/bin/bash
set -eu
case "$1" in
*/preflight.php)
    echo preflight >> "$DANKS_TEST_ROOT/trace"
    if [ "$1" != "$DANKS_TEST_ROOT/app/preflight.php" ]; then
        dirname "$1" > "$DANKS_TEST_ROOT/candidate-path"
    fi
    if [ "$1" = "$DANKS_TEST_ROOT/app/preflight.php" ]; then
        exit "$DANKS_TEST_POSTFLIGHT_STATUS"
    fi
    exit "$DANKS_TEST_STATUS" ;;
*/composer.phar) echo "composer:$PWD" >> "$DANKS_TEST_ROOT/trace" ;;
artisan) echo "artisan:$2" >> "$DANKS_TEST_ROOT/trace" ;;
*) exit 91 ;;
esac
SH);
    chmod($root.'/bin/git', 0700);
    chmod($root.'/bin/php', 0700);
    try {
        $process = new Process(['bash', base_path('deploy.sh')], base_path(), [
            'PATH' => $root.'/bin:'.getenv('PATH'),
            'DANKS_DEPLOY_APP_DIR' => $root.'/app', 'DANKS_DEPLOY_PUBLIC_DIR' => $root.'/public',
            'DANKS_DEPLOY_PHP_BIN' => $root.'/bin/php', 'DANKS_DEPLOY_COMPOSER' => $root.'/composer.phar',
            'DANKS_DEPLOY_LOCK_FILE' => $root.'/lock', 'COMPOSER_HOME' => $root.'/composer',
            'COMPOSER_CACHE_DIR' => $root.'/composer/cache', 'DANKS_TEST_ROOT' => $root, 'DANKS_TEST_STATUS' => (string) $status, 'DANKS_TEST_POSTFLIGHT_STATUS' => (string) $postflightStatus,
        ]);
        $process->run();
        $trace = file_get_contents($root.'/trace');
        expect($process->getExitCode())->toBe($status ?: $postflightStatus)
            ->and(file_get_contents($root.'/app/.env'))->toBe('SENTINEL=private-value')
            ->and(file_get_contents($root.'/app/bootstrap/cache/config.php'))->toBe('<?php return ["stale" => true];')
            ->and(is_dir(trim(file_get_contents($root.'/candidate-path'))))->toBeFalse()
            ->and(file_get_contents($root.'/app/storage/logs/deploy.log'))->not->toContain('private-value');
        if ($status !== 0) {
            expect($trace)->not->toContain('reset:', 'artisan:', 'composer:'.$root.'/app')
                ->and(file_get_contents($root.'/public/build/old.txt'))->toBe('old')
                ->and(file_get_contents($root.'/public/robots.txt'))->toBe('old robots')
                ->and(file_get_contents($root.'/public/sitemap.xml'))->toBe('old sitemap');
        } else {
            expect(strpos($trace, 'preflight'))->toBeLessThan(strpos($trace, 'artisan:down'))
                ->and(strpos($trace, 'artisan:down'))->toBeLessThan(strpos($trace, 'reset:'))
                ->and($trace)->toContain('reset:aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'artisan:optimize')
                ->and(is_file($root.'/public/robots.txt'))->toBeFalse()
                ->and(file_get_contents($root.'/public/build/new.txt'))->toBe('new');
            if ($postflightStatus === 0) {
                expect($trace)->toContain('artisan:up');
            } else {
                expect($trace)->not->toContain('artisan:up');
                expect(file_get_contents($root.'/app/storage/logs/deploy.log'))->toContain('maintenance mode retained');
            }
        }
    } finally {
        File::deleteDirectory($root);
    }
})->with([[0, 0], [1, 0], [0, 1]]);
