<?php

namespace App\Http\Middleware;

use App\Support\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalSite
{
    public function handle(Request $request, Closure $next): Response
    {
        $origin = Site::origin();
        $host = parse_url($origin, PHP_URL_HOST);
        if (app()->isProduction() && config('site.canonical_redirects')
            && in_array($host, config('site.alternate_hosts'), true)
            && in_array($request->getHost(), config('site.alternate_hosts'), true)
            && in_array($request->method(), ['GET', 'HEAD'], true)
            && $request->getSchemeAndHttpHost() !== $origin) {
            return redirect($origin.$request->getRequestUri(), 301);
        }

        $response = $next($request);
        if (! Site::indexable()) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow');
        }

        return $response;
    }
}
