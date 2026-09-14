<?php

use App\Support\ProductionPreflight;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

function productionConfiguration(): array
{
    return [
        'app' => ['env' => 'production', 'debug' => false, 'url' => 'https://danksandstrydom.co.za'],
        'site' => ['indexable' => true, 'canonical_redirects' => true],
        'contact' => ['recipients' => ['inbox@example.test'], 'practice' => [
            'name' => 'Test practice', 'phone' => '+27 11 123 4567', 'email' => 'public@example.test',
            'location_verified' => true, 'address' => 'Approved address', 'street' => 'Approved street',
            'locality' => 'Approved locality', 'region' => 'Approved region', 'postcode' => '1234', 'country' => 'ZA',
            'map_embed_url' => 'https://www.google.com/maps/embed?approved=test',
            'directions_url' => 'https://www.google.com/maps?approved=test',
        ]],
    ];
}

it('accepts an effective production configuration without returning values', function () {
    expect((new ProductionPreflight)->failures(new Repository(productionConfiguration())))->toBe([]);
});

it('rejects unsafe production configuration by key only', function (string $key, mixed $value) {
    $config = new Repository(productionConfiguration());
    $config->set($key, $value);
    expect((new ProductionPreflight)->failures($config))->toBe([$key]);
})->with([
    ['app.env', 'local'], ['app.env', 'staging'], ['app.debug', true], ['app.debug', 'false'],
    ['app.url', 'http://danksandstrydom.co.za'], ['app.url', 'https://www.danksandstrydom.co.za'],
    ['app.url', 'https://danksandstrydom.co.za.evil.test'], ['app.url', 'https://user:secret@danksandstrydom.co.za'],
    ['app.url', 'https://danksandstrydom.co.za/path'], ['app.url', 'https://danksandstrydom.co.za?secret=value'],
    ['app.url', 'https://danksandstrydom.co.za:8443'], ['site.indexable', false], ['site.indexable', 'true'],
    ['site.canonical_redirects', false], ['contact.recipients', []], ['contact.recipients', ['valid@example.test', 'invalid']],
    ['contact.practice.phone', ''], ['contact.practice.phone', '0000000000'], ['contact.practice.email', 'invalid'],
    ['contact.practice.address', ''], ['contact.practice.street', ''], ['contact.practice.locality', ''],
    ['contact.practice.region', ''], ['contact.practice.postcode', ''], ['contact.practice.location_verified', false],
    ['contact.practice.map_embed_url', '<iframe src="secret">'], ['contact.practice.directions_url', 'http://maps.example.test'],
]);

function preflightEnvironment(): string
{
    return <<<'ENV'
APP_ENV=production
APP_DEBUG=false
APP_URL=https://danksandstrydom.co.za
SITE_INDEXABLE=true
SITE_CANONICAL_REDIRECTS=true
CONTACT_MAIL_TO=inbox@example.test
CONTACT_PHONE="+27 11 123 4567"
CONTACT_EMAIL=public@example.test
CONTACT_LOCATION_VERIFIED=true
CONTACT_ADDRESS="Approved address"
CONTACT_STREET="Approved street"
CONTACT_LOCALITY="Approved locality"
CONTACT_REGION="Approved region"
CONTACT_POSTCODE=1234
CONTACT_MAP_EMBED_URL=https://www.google.com/maps/embed?approved=test
CONTACT_DIRECTIONS_URL=https://www.google.com/maps?approved=test
ENV;
}

it('validates fresh env independently of an inherited stale cache without changing it', function (bool $valid) {
    $directory = sys_get_temp_dir().'/danks-preflight-'.bin2hex(random_bytes(8));
    mkdir($directory, 0700);
    $environment = preflightEnvironment();
    if (! $valid) {
        $environment = str_replace('SITE_INDEXABLE=true', 'SITE_INDEXABLE=false', $environment);
    }
    file_put_contents($directory.'/.env', $environment);
    $cachedConfig = productionConfiguration();
    $cachedConfig['site']['indexable'] = ! $valid;
    file_put_contents($directory.'/cached.php', '<?php return '.var_export($cachedConfig, true).';');
    $before = hash_file('sha256', $directory.'/cached.php');
    $processEnv = ['APP_CONFIG_CACHE' => $directory.'/cached.php'];
    foreach (preg_split('/\R/', preflightEnvironment()) as $line) {
        $processEnv[explode('=', $line, 2)[0]] = false;
    }
    try {
        $process = new Process([PHP_BINARY, base_path('preflight.php'), $directory.'/.env'], base_path(), $processEnv);
        $process->run();
        expect($process->getExitCode())->toBe($valid ? 0 : 1)
            ->and(hash_file('sha256', $directory.'/cached.php'))->toBe($before)
            ->and($process->getOutput().$process->getErrorOutput())->not->toContain('inbox@example.test', 'Approved street');
        if (! $valid) {
            expect($process->getErrorOutput())->toContain('site.indexable');
        }
        $cachedProcess = new Process([PHP_BINARY, base_path('preflight.php'), $directory.'/.env', '--cached'], base_path(), $processEnv);
        $cachedProcess->run();
        expect($cachedProcess->getExitCode())->toBe($valid ? 1 : 0)
            ->and(hash_file('sha256', $directory.'/cached.php'))->toBe($before);
        $processEnv['APP_DEBUG'] = 'true';
        $overrideProcess = new Process([PHP_BINARY, base_path('preflight.php'), $directory.'/.env'], base_path(), $processEnv);
        $overrideProcess->run();
        expect($overrideProcess->getExitCode())->toBe(1)->and($overrideProcess->getErrorOutput())->toContain('app.debug');

    } finally {
        File::deleteDirectory($directory);
    }
})->with([true, false]);

it('rejects malformed dotenv without printing its secret or parser diagnostics', function () {
    $path = tempnam(sys_get_temp_dir(), 'danks-env-');
    file_put_contents($path, 'SECRET="unclosed-private-sentinel" invalid trailing text');
    try {
        $process = new Process([PHP_BINARY, base_path('preflight.php'), $path], base_path());
        $process->run();
        expect($process->getExitCode())->toBe(1)
            ->and($process->getOutput().$process->getErrorOutput())->toContain('could not validate')
            ->not->toContain('unclosed-private-sentinel', 'Stack trace');
    } finally {
        unlink($path);
    }
});
