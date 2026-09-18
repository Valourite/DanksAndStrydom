<?php

// Configuration-only bootstrap: no providers, mail, migrations or active cache writes.
use App\Support\ProductionPreflight;
use Dotenv\Dotenv;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Support\Env;

ini_set('display_errors', '0');
ini_set('log_errors', '0');
set_error_handler(function (int $severity, string $message, string $file, int $line): never {
    throw new ErrorException('Preflight runtime failure.', 0, $severity, $file, $line);
});

try {
    require __DIR__.'/vendor/autoload.php';

    $environmentFile = $argv[1] ?? '';
    if (! is_file($environmentFile) || ! is_readable($environmentFile)) {
        throw new RuntimeException('Environment unavailable.');
    }
    // Load the explicit server .env; inherited environment overrides still apply.
    // Catch dotenv errors here rather than printing its potentially sensitive diagnostics.
    Dotenv::create(Env::getRepository(), dirname($environmentFile), basename($environmentFile))->load();
    $cached = in_array('--cached', $argv ?? [], true);
    $app = $cached ? new Application(__DIR__) : new class(__DIR__) extends Application
    {
        public function getCachedConfigPath(): string
        {
            return $this->bootstrapPath('cache/preflight-uncached.php');
        }
    };
    if ($app->configurationIsCached() !== $cached) {
        throw new RuntimeException('Unexpected configuration cache state.');
    }
    (new LoadConfiguration)->bootstrap($app);
    $failures = (new ProductionPreflight)->failures($app->make('config'));
    if ($failures !== []) {
        fwrite(STDERR, 'Production preflight rejected configuration keys: '.implode(', ', $failures).PHP_EOL);
        exit(1);
    }
    fwrite(STDOUT, 'Production preflight passed; configuration values were not printed.'.PHP_EOL);
} catch (Throwable) {
    fwrite(STDERR, 'Production preflight could not validate configuration. Check the environment file and candidate dependencies privately.'.PHP_EOL);
    exit(1);
}
