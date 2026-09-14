<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ReviewPreview
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->attributes->remove('site_review_authenticated');
        if (! app()->environment('staging') || config('site.review_preview') !== true) {
            return $next($request);
        }

        $headers = ['Cache-Control' => 'private, no-store', 'X-Robots-Tag' => 'noindex, nofollow'];
        $username = (string) config('site.review_username');
        $hash = (string) config('site.review_password_hash');
        if ($username === '' || $hash === '' || ! $request->isSecure()) {
            return response('Review preview unavailable.', 503, $headers);
        }

        $key = 'site-review:'.hash('sha256', (string) $request->ip());
        if (RateLimiter::tooManyAttempts($key, 10)) {
            return response('Please try again later.', 429, $headers);
        }
        if (! hash_equals($username, (string) $request->getUser()) || ! password_verify((string) $request->getPassword(), $hash)) {
            RateLimiter::hit($key, 60);

            return response('Authentication required.', 401, $headers + ['WWW-Authenticate' => 'Basic realm="Practice review", charset="UTF-8"']);
        }

        RateLimiter::clear($key);
        $request->attributes->set('site_review_authenticated', true);
        $response = $next($request);
        foreach ($headers as $name => $value) {
            $response->headers->set($name, $value);
        }

        return $response;
    }
}
