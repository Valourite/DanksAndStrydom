# Laravel cPanel Deployment Guide

This guide explains how to deploy a Laravel website on a shared cPanel hosting account where the application is stored inside the cPanel `repositories` folder and served through `public_html`.

This setup is useful when the hosting provider does not allow the domain document root to be changed directly to Laravel's `/public` folder.

## Final Hosting Structure

The final structure should look like this:

```text
/home/CPANEL_USER/
├── public_html/
│   ├── index.php
│   ├── .htaccess
│   ├── build -> /home/CPANEL_USER/repositories/PROJECT_NAME/public/build
│   └── images -> /home/CPANEL_USER/repositories/PROJECT_NAME/public/images
│   └── any folder actually -> /home/CPANEL_USER/repositories/PROJECT_NAME/public/that folder to symlink...
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
│       ├── vendor/
│       ├── .env
│       ├── artisan
│       ├── composer.json
│       ├── composer.lock
│       ├── package.json
│       └── vite.config.js
│
└── composer.phar
```

Example for this project hosted on danksandstrydom.co.za:

```text
/home/danks/
├── public_html/
└── repositories/
    └── DanksAndStrydom/
```

## Important Hosting Requirement

Before setting up Laravel on cPanel, ask the hosting provider to enable **Terminal access** for the cPanel account (they should give you jailed terminal access for that cPanel account).

Example request:

```text
Please enable Terminal or SSH access for this cPanel account.

We need terminal access to run Laravel commands, Composer, Git commands, and manage symlinks for a Laravel application hosted from the cPanel repositories folder.
```

Without terminal access, Laravel deployment becomes much harder because you cannot run Composer, Artisan, Git, or symlink commands.

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

Public asset folders such as `build` and `images` are symlinked from `public_html` to the repo’s `public` folder.

This means when the repo is updated, the public assets update automatically.

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

## Step 2: Keep `public_html` as a Real Folder

Do not symlink the whole `public_html` folder to Laravel’s `/public` folder.

On some shared hosts, Apache/cPanel does not serve `public_html` correctly when the entire folder is a symlink. This can result in a hosting-provider 404 page instead of a Laravel response.

Use a real `public_html` folder instead.

## Step 3: Copy Laravel Public Files to `public_html`

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

Example for this project:

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

The repo’s own file can remain unchanged:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/public/index.php
```

That file should stay as Laravel’s default `public/index.php`.

## Step 5: Update `public_html/.htaccess`

Edit:

```text
/home/CPANEL_USER/public_html/.htaccess
```

Use Laravel’s rewrite rules:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    DirectoryIndex index.php

    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

Make sure there are no Node.js Passenger rules in this file.

Remove anything like:

```apache
PassengerAppRoot
PassengerBaseURI
PassengerNodejs
PassengerStartupFile
PassengerAppType node
```

Node.js must not serve the Laravel website, so do not run a nodejs application for this project via the cPanel nodejs application.

We let the build files comes with the git push so we can access them and serve them over the web, essentially cutting out the need for npm and node_modules folder

Laravel must be served by PHP through `public_html/index.php`.

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
```

Generate the app key locally or on the server:

```bash
php artisan key:generate --show
```

Then paste the generated value into:

```env
APP_KEY=
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

the real database name may be (danks_ prefixed):

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

Example for this project:

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

Use a normal Laravel-style `.gitignore`.

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

For this shared-hosting setup, there is only one possible approach for Vite build files.

### Build Locally and Commit `public/build`

Use this if the server cannot run `npm run build` (which shared servers can't).

Do not ignore:

```gitignore
/public/build
```

So inside the .gitignore file, make sure /public/build is not ignored

Run locally:

```bash
npm install
npm run build
git add public/build
git commit -m "Build production assets"
git push origin main
```

## Step 11: Symlink Public Asset Folders

Because the live site uses:

```text
/home/CPANEL_USER/public_html
```

but the repo assets are inside:

```text
/home/CPANEL_USER/repositories/PROJECT_NAME/public
```

create symlinks for public asset folders.

### Symlink `build`

```bash
rm -rf /home/CPANEL_USER/public_html/build

ln -s /home/CPANEL_USER/repositories/PROJECT_NAME/public/build /home/CPANEL_USER/public_html/build
```

Example:

```bash
rm -rf /home/danks/public_html/build

ln -s /home/danks/repositories/DanksAndStrydom/public/build /home/danks/public_html/build
```

### Symlink `images`

```bash
rm -rf /home/CPANEL_USER/public_html/images

ln -s /home/CPANEL_USER/repositories/PROJECT_NAME/public/images /home/CPANEL_USER/public_html/images
```

Example:

```bash
rm -rf /home/danks/public_html/images

ln -s /home/danks/repositories/DanksAndStrydom/public/images /home/danks/public_html/images
```

Check symlinks:

```bash
ls -la /home/CPANEL_USER/public_html
```

You should see something like:

```text
build -> /home/CPANEL_USER/repositories/PROJECT_NAME/public/build
images -> /home/CPANEL_USER/repositories/PROJECT_NAME/public/images
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

## Step 13: Run Laravel Commands

From the Laravel repo:

```bash
cd /home/CPANEL_USER/repositories/PROJECT_NAME
```

Clear and rebuild Laravel caches:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If the project uses migrations and the database is ready, run:

```bash
php artisan migrate --force
```

For a simple marketing site/contact form, migrations may not be needed.

## Step 14: Deployment Workflow

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

### cPanel Deployment

SSH/Terminal into cPanel:

```bash
cd /home/CPANEL_USER/repositories/PROJECT_NAME
```

Pull the latest code:

```bash
git pull origin main
```

*^^This can also be done by going to the Git Version Control, finding the repo and updating the branch*

Install/update PHP dependencies:

```bash
php /home/CPANEL_USER/composer.phar install --no-dev --prefer-dist --optimize-autoloader
```

Clear/rebuild Laravel caches:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Run migrations if needed:

```bash
php artisan migrate --force
```

Because `public_html/build` and `public_html/images` are symlinks, updated assets from the repo are available immediately after `git pull`.

## Step 15: Troubleshooting

### Host Provider 404 Page

If you see a hosting-provider 404 page, Apache is probably not reaching Laravel.

Check:

```bash
ls -la /home/CPANEL_USER/public_html
```

Make sure `public_html` is a real folder, not a full symlink to the repo.

This setup intentionally does not symlink the whole `public_html` folder because some shared hosts do not serve it correctly.

### Laravel 404 Page

If you see a Laravel 404, Apache is reaching Laravel, but the route does not exist.

Check:

```text
routes/web.php
```

Make sure `/` is defined.

### Missing Styles

If the site loads but has no styling, check:

```bash
ls -la /home/CPANEL_USER/public_html/build
ls -la /home/CPANEL_USER/repositories/PROJECT_NAME/public/build
```

Make sure `public_html/build` points to the repo’s `public/build`.

### Node.js “It Works” Page

If the website shows a Node.js page saying “It works!” and displays a Node version, cPanel is serving a Node.js app instead of Laravel.

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
Build Vite assets locally if server build fails
Commit public/build if building locally
Symlink public_html/build to repo public/build
Symlink public_html/images to repo public/images
Keep .env only on the server
Use terminal access for git pull, composer install, and artisan commands
```

## Example Commands for Danks & Strydom

```bash
cd /home/danks/repositories/DanksAndStrydom

git pull origin main

php /home/danks/composer.phar install --no-dev --prefer-dist --optimize-autoloader

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If migrations are needed:

```bash
php artisan migrate --force
```
