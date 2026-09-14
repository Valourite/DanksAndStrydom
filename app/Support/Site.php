<?php

namespace App\Support;

class Site
{
    public static function origin(): string
    {
        return rtrim((string) config('app.url'), '/');
    }

    public static function url(string $path = '/'): string
    {
        return self::origin().'/'.ltrim($path, '/');
    }

    public static function indexable(): bool
    {
        return app()->isProduction() && (bool) config('site.indexable');
    }

    public static function reviewing(): bool
    {
        return app()->environment('staging') && config('site.review_preview') === true
            && request()->attributes->get('site_review_authenticated') === true;
    }

    /** @return array<string, array<string, mixed>> */
    public static function services(): array
    {
        return array_filter(self::pages(), fn (array $page): bool => str_starts_with($page['path'], '/services/'));
    }

    /** @return array<string, array<string, mixed>> */
    public static function pages(): array
    {
        return array_filter(config('site.pages'), fn (array $page): bool => $page['published'] || self::reviewing());
    }
}
