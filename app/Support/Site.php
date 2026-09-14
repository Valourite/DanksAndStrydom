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

    /** @return array<string, array<string, mixed>> */
    public static function pages(): array
    {
        return array_filter(config('site.pages'), fn (array $page): bool => $page['published']);
    }
}
