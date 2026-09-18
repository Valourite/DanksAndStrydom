<?php

namespace App\Support;

use Illuminate\Contracts\Config\Repository;

class ProductionPreflight
{
    /** @return list<string> Failed configuration keys, never their values. */
    public function failures(Repository $config): array
    {
        $failures = [];
        foreach (['app.env' => 'production', 'app.debug' => false, 'site.indexable' => true, 'site.canonical_redirects' => true, 'contact.practice.location_verified' => true] as $key => $expected) {
            if ($config->get($key) !== $expected) {
                $failures[] = $key;
            }
        }

        if (! in_array($config->get('app.url'), ['https://danksandstrydom.co.za', 'https://danksandstrydom.co.za/'], true)) {
            $failures[] = 'app.url';
        }

        $recipients = $config->get('contact.recipients');
        if (! is_array($recipients) || $recipients === [] || array_filter($recipients, fn (mixed $email): bool => ! $this->validEmail($email)) !== []) {
            $failures[] = 'contact.recipients';
        }
        if (! $this->validEmail($config->get('contact.practice.email'))) {
            $failures[] = 'contact.practice.email';
        }

        $phone = $config->get('contact.practice.phone');
        $digits = is_string($phone) ? (preg_replace('/\D/', '', $phone) ?? '') : '';
        if (! is_string($phone) || ! preg_match('/^\+?[0-9 ()-]+$/', $phone) || strlen($digits) < 7 || strlen($digits) > 15 || trim($digits, '0') === '') {
            $failures[] = 'contact.practice.phone';
        }

        foreach (['name', 'address', 'street', 'locality', 'region', 'postcode', 'country'] as $field) {
            $key = 'contact.practice.'.$field;
            $value = $config->get($key);
            if (! is_string($value) || trim($value) === '') {
                $failures[] = $key;
            }
        }
        foreach (['map_embed_url', 'directions_url'] as $field) {
            $key = 'contact.practice.'.$field;
            $value = $config->get($key);
            if (! is_string($value) || ! filter_var($value, FILTER_VALIDATE_URL) || parse_url($value, PHP_URL_SCHEME) !== 'https' || parse_url($value, PHP_URL_USER) !== null || parse_url($value, PHP_URL_PASS) !== null) {
                $failures[] = $key;
            }
        }

        return $failures;
    }

    private function validEmail(mixed $email): bool
    {
        return is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
