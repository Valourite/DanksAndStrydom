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

    /** @return list<array<string, mixed>> */
    public static function testimonials(): array
    {
        $entries = array_values(array_filter(config('site.testimonials.entries', []), fn (array $entry): bool => ($entry['approved'] ?? false) === true && filled($entry['quote'] ?? null) && filled($entry['display_name'] ?? null)
        ));
        $samples = $entries === [] && app()->environment('local', 'staging');
        if ($samples) {
            $entries = config('site.testimonials.samples', []);
        }

        return array_values(array_map(function (array $entry) use ($samples): array {
            $source = $entry['source_url'] ?? null;
            $entry['source_url'] = is_string($source) && filter_var($source, FILTER_VALIDATE_URL)
                && in_array(parse_url($source, PHP_URL_SCHEME), ['https', 'http'], true) ? $source : null;
            $entry['sample'] = $samples;

            return $entry;
        }, $entries));
    }

    /** @return array<string, array<string, mixed>> */
    public static function services(): array
    {
        return array_filter(self::pages(), fn (array $page): bool => str_starts_with($page['path'], '/services/'));
    }

    /** @return array<string, array<string, mixed>> */
    public static function pages(): array
    {
        return array_filter(config('site.pages'), fn (array $page): bool => $page['published']);
    }
}
