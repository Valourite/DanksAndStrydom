#!/bin/bash
set -euo pipefail

APP_DIR="${DANKS_DEPLOY_APP_DIR:-/home/danks/repositories/DanksAndStrydom}"
PUBLIC_DIR="${DANKS_DEPLOY_PUBLIC_DIR:-/home/danks/public_html}"
PHP_BIN="${DANKS_DEPLOY_PHP_BIN:-/usr/local/bin/php}"
COMPOSER="${DANKS_DEPLOY_COMPOSER:-/home/danks/composer.phar}"
BRANCH="main"

LOG_FILE="$APP_DIR/storage/logs/deploy.log"
LOCK_FILE="${DANKS_DEPLOY_LOCK_FILE:-/tmp/danksandstrydom-deploy.lock}"

# Required when running Composer from a web-triggered process.
export COMPOSER_HOME="${COMPOSER_HOME:-/home/danks/.composer}"
export COMPOSER_CACHE_DIR="${COMPOSER_CACHE_DIR:-/home/danks/.composer/cache}"

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

    umask 077
    CANDIDATE_DIR="$(mktemp -d /tmp/danks-release.XXXXXXXX)"
    MAINTENANCE_STARTED=false
    RELEASE_READY=false
    cleanup() {
        rm -rf "$CANDIDATE_DIR"
        if [ "$MAINTENANCE_STARTED" = true ]; then
            if [ "$RELEASE_READY" = true ]; then
                bring_app_up
            else
                echo "Deployment did not complete; maintenance mode retained. Restore the prior release or resolve the failure before bringing the site up."
            fi
        fi
    }
    trap cleanup EXIT
    trap 'exit 130' INT
    trap 'exit 143' TERM

    echo ""
    echo "=================================================="
    echo "Deployment started: $(date)"
    echo "=================================================="

    cd "$APP_DIR"

    echo "Fetching candidate code without changing the active checkout..."
    git fetch origin "$BRANCH"
    TARGET_SHA="$(git rev-parse "origin/$BRANCH^{commit}")"
    git archive "$TARGET_SHA" | tar -x -C "$CANDIDATE_DIR"

    # Explicit .env semantics must match the later Artisan cache rebuild.
    if [ ! -f "$APP_DIR/.env" ] || [ -f "$APP_DIR/.env.production" ]; then
        echo "Preflight requires an existing .env and no overriding .env.production. Resolve privately."
        exit 1
    fi
    ENV_DIGEST="$(sha256sum "$APP_DIR/.env")"
    cp "$APP_DIR/.env" "$CANDIDATE_DIR/.env"
    chmod 600 "$CANDIDATE_DIR/.env"

    # Independent vendor avoids loading the active checkout's classes via its classmap.
    # No candidate Composer scripts or plugins may run before validation.
    echo "Preparing isolated candidate dependencies..."
    (cd "$CANDIDATE_DIR" && "$PHP_BIN" "$COMPOSER" install --no-dev --no-scripts --no-plugins --prefer-dist --optimize-autoloader --no-interaction)
    "$PHP_BIN" "$CANDIDATE_DIR/preflight.php" "$CANDIDATE_DIR/.env"
    test -f "$CANDIDATE_DIR/public/build/manifest.json"
    if [ "$ENV_DIGEST" != "$(sha256sum "$APP_DIR/.env")" ]; then
        echo "Environment changed during preflight; aborting before activation."
        exit 1
    fi

    echo "Preflight passed. Putting app into maintenance mode..."
    "$PHP_BIN" artisan down
    MAINTENANCE_STARTED=true

    echo "Activating the exact validated revision..."
    git reset --hard "$TARGET_SHA"

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

    echo "Removing obsolete static SEO files so Laravel handles environment-aware discovery..."
    rm -f "$PUBLIC_DIR/robots.txt" "$PUBLIC_DIR/sitemap.xml"

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

    echo "Checking the rebuilt effective production configuration..."
    "$PHP_BIN" "$APP_DIR/preflight.php" "$APP_DIR/.env" --cached
    RELEASE_READY=true

    echo "Deployment completed: $(date)"
    echo "=================================================="

) 9>"$LOCK_FILE" >> "$LOG_FILE" 2>&1
