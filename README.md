# Laravel cPanel Deployment Guide

This guide explains how to deploy a Laravel website on a shared cPanel hosting account where the Laravel application is stored inside cPanel's `repositories` folder, while the live domain is served through `public_html`.

This setup was built for a shared hosting environment where:

- The domain document root could not reliably be changed to Laravel's `/public` directory.
- The entire `public_html` folder could not be symlinked to the repo's `/public` folder.
- Symlinked asset folders were not reliable on LiteSpeed.
- Composer was not available globally, so `composer.phar` was installed inside the cPanel home directory.
- Vite/Tailwind build assets are built locally and committed to Git.
- Deployment is handled by a reusable `deploy.sh` script.
- Optional web-based deployment is available through a protected Laravel `/deploy` route.

## Final Hosting Structure

The final structure should look like this:

```text
/home/CPANEL_USER/
├── public_html/
│   ├── index.php
│   ├── .htaccess
│   ├── build/              <- copied from repo public/build during deployment
│   └── images/             <- copied from repo public/images during deployment
│
├── repositories/
│   └── PROJECT_NAME/
│       ├── app/
│       ├── bootstrap/
│       ├── config/
│       ├── database/
│       ├── public/
│       │   ├── build/
│       │   └── images/
│       ├── resources/
│       ├── routes/
│       ├── storage/
│       ├── vendor/         <- installed on the server by Composer
│       ├── .env            <- server-only file, never committed
│       ├── artisan
│       ├── composer.json
│       ├── composer.lock
│       ├── package.json
│       ├── vite.config.js
│       ├── deploy.sh
│       └── .cpanel.yml     <- optional, for cPanel Deploy HEAD Commit
│
└── composer.phar
```

Example for Danks & Strydom:

```text
/home/danks/
├── public_html/
├── composer.phar
└── repositories/
    └── DanksAndStrydom/
```

## Important Hosting Requirement

Before setting up Laravel on cPanel, ask the hosting provider to enable **Terminal access** for the cPanel account.

Example request:

```text
Please enable Terminal or SSH access for this cPanel account.

We need terminal access to run Laravel commands, Composer, Git commands, and deployment scripts for a Laravel application hosted from the cPanel repositories folder.
```

Without terminal access, Laravel deployment becomes much harder because you cannot run Composer, Artisan, Git, or deployment commands.

## Why This Setup Is Needed

Laravel expects the web server to point directly to the Laravel `/public` directory.

On many cPanel shared hosting accounts, the domain points to:

```text
/home/CPANEL_USER/public_html
```

and the user may not be able to change the document root.

To work around this, we keep the Laravel app inside:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME
```

and use a custom `public_html/index.php` to load the Laravel app from the repo.

The public asset folders such as `build` and `images` are copied from the repo into `public_html` during deployment.

This is more reliable than symlinking on shared hosting because some LiteSpeed/cPanel environments do not serve symlinked public folders correctly.

## Step 1: Clone the Repo in cPanel

In cPanel, go to:

```text
Git Version Control
```

Clone the project into:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME
```

Example:

```text
/home/danks/repositories/DanksAndStrydom
```

This creates a server-side clone of the GitHub repo.

## Step 2: Keep `public_html` as a Real Folder

Do not symlink the whole `public_html` folder to Laravel's `/public` folder.

On some shared hosts, Apache/LiteSpeed/cPanel does not serve `public_html` correctly when the entire folder is a symlink. This can result in a hosting-provider 404 page instead of a Laravel response.

Use a real `public_html` folder instead.

## Step 3: Copy Laravel Public Entry Files to `public_html`

Copy the contents of:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/public
```

into:

```text
/home/CPANEL_USER/public_html
```

At minimum, `public_html` should contain:

```text
index.php
.htaccess
favicon.ico
robots.txt
```

Do not copy the entire Laravel application into `public_html`.

Only the public entry files belong there.

The deploy script will later keep these asset folders updated:

```text
public_html/build
public_html/images
```

## Step 4: Update `public_html/index.php`

Edit:

```text
/home/CPANEL_USER/public_html/index.php
```

Change the paths so that it loads Laravel from the repo.

Use this structure:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../repositories/PROJECT_NAME/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../repositories/PROJECT_NAME/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../repositories/PROJECT_NAME/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

Example for Danks & Strydom:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../repositories/DanksAndStrydom/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../repositories/DanksAndStrydom/vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../repositories/DanksAndStrydom/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

The repo's own file can remain unchanged:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/public/index.php
```

That file should stay as Laravel's default `public/index.php`.

## Step 5: Update `public_html/.htaccess`

Edit:

```text
/home/CPANEL_USER/public_html/.htaccess
```

Use Laravel's rewrite rules:

```apache
<IfModule mod_rewrite.c>
    Options -MultiViews -Indexes

    DirectoryIndex index.php

    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

If you test symlinks and need ownership-matched symlink support, you can use:

```apache
Options +SymLinksIfOwnerMatch -MultiViews -Indexes
```

However, if symlinked assets still return a PHP/Laravel 404, do not rely on symlinks. Use the copied asset folder approach in `deploy.sh`.

Make sure there are no Node.js Passenger rules in this file.

Remove anything like:

```apache
PassengerAppRoot
PassengerBaseURI
PassengerNodejs
PassengerStartupFile
PassengerAppType node
```

Node.js must not serve the Laravel website.

Laravel must be served by PHP through:

```text
public_html/index.php
```

## Step 6: Create the `.env` File

Create:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/.env
```

Example:

```env
APP_NAME="Project Name"
APP_ENV=production
APP_KEY=base64:PASTE_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://example.com

LOG_CHANNEL=single
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanelprefix_database
DB_USERNAME=cpanelprefix_user
DB_PASSWORD=database_password

CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=mail.example.com
MAIL_PORT=465
MAIL_USERNAME=info@example.com
MAIL_PASSWORD=email_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@example.com
MAIL_FROM_NAME="Project Name"

DEPLOY_TOKEN=PASTE_A_LONG_RANDOM_TOKEN_HERE
```

Generate the app key locally or on the server:

```bash
php artisan key:generate --show
```

Then paste the generated value into:

```env
APP_KEY=
```

Generate a deploy token locally or on a machine with OpenSSL:

```bash
openssl rand -hex 48
```

Paste that value into:

```env
DEPLOY_TOKEN=
```

Do not commit `.env` to Git.

## Step 7: Create the Database

In cPanel, go to:

```text
Databases Wizard
```

Create:

1. A database
2. A database user
3. Assign the user to the database
4. Give the user `ALL PRIVILEGES`

cPanel usually prefixes database names and usernames.

For example, if the cPanel username is:

```text
danks
```

and you create a database called:

```text
website
```

the real database name may be:

```text
danks_website
```

Use the full cPanel-prefixed names in `.env`.

Example:

```env
DB_DATABASE=danks_website
DB_USERNAME=danks_laravel
DB_PASSWORD=your_password
```

## Step 8: Install Composer Locally on the cPanel Account

If Composer is not available globally, use `composer.phar`.

This was the working approach for this setup.

Go to the home directory:

```bash
cd /home/CPANEL_USER
```

Download Composer:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```

Install Composer as `composer.phar` in the cPanel home directory:

```bash
php composer-setup.php --install-dir=/home/CPANEL_USER --filename=composer.phar
```

Remove the installer:

```bash
php -r "unlink('composer-setup.php');"
```

Check Composer works:

```bash
php /home/CPANEL_USER/composer.phar --version
```

Example for Danks & Strydom:

```bash
cd /home/danks

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/home/danks --filename=composer.phar
php -r "unlink('composer-setup.php');"

php /home/danks/composer.phar --version
```

## Step 9: Install PHP Dependencies

Go to the Laravel repo:

```bash
cd /home/CPANEL_USER/repositories/PROJECT_NAME
```

Install production Composer dependencies:

```bash
php /home/CPANEL_USER/composer.phar install --no-dev --prefer-dist --optimize-autoloader
```

Example:

```bash
cd /home/danks/repositories/DanksAndStrydom

php /home/danks/composer.phar install --no-dev --prefer-dist --optimize-autoloader
```

This creates the `vendor` folder on the server.

Because Composer now works on the server, `vendor` should not be committed to Git.

## Step 10: Git Ignore Rules

Use a mostly normal Laravel-style `.gitignore`.

Make sure these are ignored:

```gitignore
/vendor
/node_modules
.env
.env.backup
.env.production
/public/hot
/storage/*.key
/storage/logs/*
/storage/framework/cache/*
/storage/framework/sessions/*
/storage/framework/views/*
/bootstrap/cache/*.php
/.phpunit.cache
/.idea
/.vscode
.DS_Store
```

For this shared-hosting setup, build Vite/Tailwind assets locally and commit `public/build`.

Do not ignore:

```gitignore
/public/build
```

If your default `.gitignore` contains `/public/build`, remove that line.

Then run locally:

```bash
npm install
npm run build
git add public/build
git commit -m "Build production assets"
git push origin main
```

The server does not need `node_modules` to serve the site. It only needs the compiled files in:

```text
public/build
```

## Step 11: Do Not Rely on Symlinked Public Assets

This setup originally tested symlinking:

```text
/home/CPANEL_USER/public_html/build
→ /home/CPANEL_USER/repositories/PROJECT_NAME/public/build
```

and:

```text
/home/CPANEL_USER/public_html/images
→ /home/CPANEL_USER/repositories/PROJECT_NAME/public/images
```

However, on some LiteSpeed/shared hosting setups, the symlink can exist in the shell but still return a Laravel/PHP 404 in the browser.

Example symptom:

```bash
ls -la /home/CPANEL_USER/public_html/build/manifest.json
# file exists

curl -I https://example.com/build/manifest.json
# HTTP/2 404
# x-powered-by: PHP/...
```

That means LiteSpeed is not treating the symlink target as a normal static file and Laravel is catching the request.

For this reason, the recommended approach is to **copy** public asset folders during deployment instead of symlinking them.

The deployment script handles this automatically:

```bash
rm -rf /home/CPANEL_USER/public_html/build
cp -R /home/CPANEL_USER/repositories/PROJECT_NAME/public/build /home/CPANEL_USER/public_html/build

rm -rf /home/CPANEL_USER/public_html/images
cp -R /home/CPANEL_USER/repositories/PROJECT_NAME/public/images /home/CPANEL_USER/public_html/images
```

## Step 12: Set Permissions

Laravel needs write access to `storage` and `bootstrap/cache`.

Run:

```bash
chmod -R 775 /home/CPANEL_USER/repositories/PROJECT_NAME/storage
chmod -R 775 /home/CPANEL_USER/repositories/PROJECT_NAME/bootstrap/cache
```

Example:

```bash
chmod -R 775 /home/danks/repositories/DanksAndStrydom/storage
chmod -R 775 /home/danks/repositories/DanksAndStrydom/bootstrap/cache
```

Public files should generally be readable:

```bash
chmod 644 /home/CPANEL_USER/public_html/index.php
chmod 644 /home/CPANEL_USER/public_html/.htaccess
```

## Step 13: Add `deploy.sh`

Create:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Example:

```bash
nano /home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Use this script:

```bash
#!/bin/bash
set -euo pipefail

APP_DIR="/home/CPANEL_USER/repositories/PROJECT_NAME"
PUBLIC_DIR="/home/CPANEL_USER/public_html"
PHP_BIN="/usr/local/bin/php"
COMPOSER="/home/CPANEL_USER/composer.phar"
BRANCH="main"

LOG_FILE="$APP_DIR/storage/logs/deploy.log"
LOCK_FILE="/tmp/project-deploy.lock"

# Required when running Composer from a web-triggered process.
export HOME="/home/CPANEL_USER"
export COMPOSER_HOME="/home/CPANEL_USER/.composer"
export COMPOSER_CACHE_DIR="/home/CPANEL_USER/.composer/cache"

mkdir -p "$APP_DIR/storage/logs"
mkdir -p "$COMPOSER_HOME"
mkdir -p "$COMPOSER_CACHE_DIR"

bring_app_up() {
    cd "$APP_DIR" || exit 1
    echo "Bringing app back online..."
    $PHP_BIN artisan up || true
}

(
    flock -n 9 || {
        echo "Another deployment is already running."
        exit 1
    }

    # If anything fails after maintenance mode starts, this ensures the site is not left down.
    trap bring_app_up EXIT

    echo ""
    echo "=================================================="
    echo "Deployment started: $(date)"
    echo "=================================================="

    cd "$APP_DIR"

    echo "Putting app into maintenance mode..."
    $PHP_BIN artisan down || true

    echo "Fetching latest code..."
    git fetch origin "$BRANCH"

    echo "Resetting working tree to origin/$BRANCH..."
    git reset --hard "origin/$BRANCH"

    echo "Installing Composer dependencies..."
    $PHP_BIN "$COMPOSER" install --no-dev --prefer-dist --optimize-autoloader --no-interaction

    echo "Copying public build assets..."
    rm -rf "$PUBLIC_DIR/build"
    cp -R "$APP_DIR/public/build" "$PUBLIC_DIR/build"

    if [ -d "$APP_DIR/public/images" ]; then
        echo "Copying public images..."
        rm -rf "$PUBLIC_DIR/images"
        cp -R "$APP_DIR/public/images" "$PUBLIC_DIR/images"
    fi

    echo "Fixing permissions..."
    chmod -R 775 "$APP_DIR/storage" || true
    chmod -R 775 "$APP_DIR/bootstrap/cache" || true
    chmod -R 755 "$PUBLIC_DIR/build" || true

    if [ -d "$PUBLIC_DIR/images" ]; then
        chmod -R 755 "$PUBLIC_DIR/images" || true
    fi

    echo "Clearing Laravel caches..."
    $PHP_BIN artisan optimize:clear

    echo "Running database migrations..."
    $PHP_BIN artisan migrate --force

    echo "Rebuilding Laravel caches..."
    $PHP_BIN artisan optimize

    echo "Deployment completed: $(date)"
    echo "=================================================="

) 9>"$LOCK_FILE" >> "$LOG_FILE" 2>&1
```

For Danks & Strydom, the file should use:

```bash
APP_DIR="/home/danks/repositories/DanksAndStrydom"
PUBLIC_DIR="/home/danks/public_html"
PHP_BIN="/usr/local/bin/php"
COMPOSER="/home/danks/composer.phar"
LOCK_FILE="/tmp/danksandstrydom-deploy.lock"

export HOME="/home/danks"
export COMPOSER_HOME="/home/danks/.composer"
export COMPOSER_CACHE_DIR="/home/danks/.composer/cache"
```

Make it executable:

```bash
chmod +x /home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Example:

```bash
chmod +x /home/danks/repositories/DanksAndStrydom/deploy.sh
```

Run it manually:

```bash
/home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Example:

```bash
/home/danks/repositories/DanksAndStrydom/deploy.sh
```

View the deployment log:

```bash
tail -n 120 /home/CPANEL_USER/repositories/PROJECT_NAME/storage/logs/deploy.log
```

Example:

```bash
tail -n 120 /home/danks/repositories/DanksAndStrydom/storage/logs/deploy.log
```

## Step 14: Optional `.cpanel.yml`

If using cPanel's **Deploy HEAD Commit** button, create this file in the repo root:

```text
.cpanel.yml
```

Use:

```yaml
---
deployment:
  tasks:
    - /bin/bash /home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Example:

```yaml
---
deployment:
  tasks:
    - /bin/bash /home/danks/repositories/DanksAndStrydom/deploy.sh
```

This allows cPanel's deploy button to call the same `deploy.sh` file.

## Step 15: Optional Protected Web Deployment Route

This is optional.

The safest deployment method is still terminal or cPanel deployment, because a Laravel route only works if Laravel can boot.

However, for convenience, you can add a protected POST-only route that calls `deploy.sh`.

### Add `DEPLOY_TOKEN` to `.env`

```env
DEPLOY_TOKEN=PASTE_A_LONG_RANDOM_TOKEN_HERE
```

### Add config to `config/services.php`

```php
'deploy' => [
    'token' => env('DEPLOY_TOKEN'),
],
```

### Add the route to `routes/web.php`

```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;

Route::post('/deploy', function (Request $request) {
    $configuredToken = (string) config('services.deploy.token');
    $providedToken = (string) $request->bearerToken();

    abort_if($configuredToken === '', 404);

    abort_unless(
        hash_equals($configuredToken, $providedToken),
        404
    );

    $result = Process::timeout(600)->run(
        '/bin/bash /home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh'
    );

    if ($result->failed()) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Deployment failed. Check storage/logs/deploy.log on the server.',
            'error' => $result->errorOutput(),
        ], 500);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Deployment completed.',
        'output' => $result->output(),
    ]);
});
```

Example for Danks & Strydom:

```php
$result = Process::timeout(600)->run(
    '/bin/bash /home/danks/repositories/DanksAndStrydom/deploy.sh'
);
```

Call it with:

```bash
curl -X POST https://example.com/deploy \
  -H "Authorization: Bearer YOUR_DEPLOY_TOKEN"
```

Example:

```bash
curl -X POST https://danksandstrydom.co.za/deploy \
  -H "Authorization: Bearer YOUR_DEPLOY_TOKEN"
```

Do not use:

```text
/deploy?token=...
```

because tokens in URLs can end up in browser history, access logs, analytics, and referrer headers.

## Step 16: Deployment Workflow

### Local Development

Make changes locally.

If frontend assets changed, build them locally:

```bash
npm run build
```

Commit and push:

```bash
git add .
git commit -m "Update site"
git push origin main
```

### cPanel Deployment Through Terminal

Run:

```bash
/home/CPANEL_USER/repositories/PROJECT_NAME/deploy.sh
```

Example:

```bash
/home/danks/repositories/DanksAndStrydom/deploy.sh
```

### cPanel Deployment Through Git Version Control

In cPanel:

```text
Git Version Control
→ Select the repo
→ Update from Remote
→ Deploy HEAD Commit
```

The `.cpanel.yml` file should call `deploy.sh`.

### Web Deployment

Call the protected route:

```bash
curl -X POST https://example.com/deploy \
  -H "Authorization: Bearer YOUR_DEPLOY_TOKEN"
```

## Step 17: Troubleshooting

### Site Stuck in Maintenance Mode

Run:

```bash
cd /home/CPANEL_USER/repositories/PROJECT_NAME
php artisan up
```

Example:

```bash
cd /home/danks/repositories/DanksAndStrydom
php artisan up
```

The improved `deploy.sh` includes a trap that runs `php artisan up` when the script exits, even if a deployment step fails.

### Composer Error: `HOME or COMPOSER_HOME environment variable must be set`

This can happen when `deploy.sh` is called through a web route because the web process does not have the same shell environment as the terminal.

Fix by including these lines in `deploy.sh`:

```bash
export HOME="/home/CPANEL_USER"
export COMPOSER_HOME="/home/CPANEL_USER/.composer"
export COMPOSER_CACHE_DIR="/home/CPANEL_USER/.composer/cache"

mkdir -p "$COMPOSER_HOME"
mkdir -p "$COMPOSER_CACHE_DIR"
```

Example:

```bash
export HOME="/home/danks"
export COMPOSER_HOME="/home/danks/.composer"
export COMPOSER_CACHE_DIR="/home/danks/.composer/cache"
```

### Missing Styles

If the site loads but has no styling, check:

```bash
ls -la /home/CPANEL_USER/public_html/build/manifest.json
curl -I https://example.com/build/manifest.json
```

You want:

```text
HTTP/2 200
```

If `public_html/build` is a symlink and the curl returns a PHP/Laravel 404, replace the symlink with a copied folder:

```bash
rm -rf /home/CPANEL_USER/public_html/build
cp -R /home/CPANEL_USER/repositories/PROJECT_NAME/public/build /home/CPANEL_USER/public_html/build
```

The `deploy.sh` file should now handle this automatically.

### Host Provider 404 Page

If you see a hosting-provider 404 page, Apache/LiteSpeed is probably not reaching Laravel.

Check:

```bash
ls -la /home/CPANEL_USER/public_html
```

Make sure `public_html` is a real folder, not a full symlink to the repo.

### Laravel 404 Page

If you see a Laravel 404, Apache/LiteSpeed is reaching Laravel, but the route does not exist.

Check:

```text
routes/web.php
```

Make sure `/` is defined.

### Node.js "It Works" Page

If the website shows a Node.js page saying "It works!" and displays a Node version, cPanel is serving a Node.js app instead of Laravel.

Fix:

1. Go to cPanel.
2. Open the Node.js app manager.
3. Stop the Node.js app.
4. Make sure the Node.js app is not assigned to the Laravel domain.
5. Remove any Passenger rules from `public_html/.htaccess`.

Laravel should be served by PHP, not Node.js.

### Composer Missing

If `composer` is not installed globally, use:

```bash
php /home/CPANEL_USER/composer.phar
```

instead of:

```bash
composer
```

### Wrong Environment Values

If Laravel seems to ignore `.env`, delete cached config:

```bash
rm -f /home/CPANEL_USER/repositories/PROJECT_NAME/bootstrap/cache/config.php
```

Then run:

```bash
php artisan optimize:clear
php artisan config:cache
```

### Permissions Errors

If Laravel cannot write logs, cache, sessions, or compiled views, run:

```bash
chmod -R 775 /home/CPANEL_USER/repositories/PROJECT_NAME/storage
chmod -R 775 /home/CPANEL_USER/repositories/PROJECT_NAME/bootstrap/cache
```

## Recommended Final Setup

For this type of cPanel Laravel deployment:

```text
Use Git for source code
Keep Laravel app in /repositories/PROJECT_NAME
Keep public_html as the public web entry folder
Customize public_html/index.php to load Laravel from the repo
Use composer.phar in the cPanel home directory
Ignore /vendor in Git
Ignore /node_modules in Git
Build Vite assets locally
Commit public/build
Keep public_html/build as a copied folder, not a symlink, if LiteSpeed blocks symlinks
Keep public_html/images as a copied folder, not a symlink, if LiteSpeed blocks symlinks
Keep .env only on the server
Use deploy.sh for repeatable deployment
Use .cpanel.yml if using cPanel Deploy HEAD Commit
Use a protected POST-only /deploy route only as a convenience
```

## Example Deployment Commands for Danks & Strydom

```bash
/home/danks/repositories/DanksAndStrydom/deploy.sh
```

Or manually:

```bash
cd /home/danks/repositories/DanksAndStrydom

git fetch origin main
git reset --hard origin/main

php /home/danks/composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction

rm -rf /home/danks/public_html/build
cp -R /home/danks/repositories/DanksAndStrydom/public/build /home/danks/public_html/build

rm -rf /home/danks/public_html/images
cp -R /home/danks/repositories/DanksAndStrydom/public/images /home/danks/public_html/images

php artisan optimize:clear
php artisan migrate --force
php artisan optimize
```
