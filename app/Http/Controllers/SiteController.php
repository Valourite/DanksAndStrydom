<?php

namespace App\Http\Controllers;

use App\Support\Site;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiteController extends Controller
{
    public function page(Request $request): View
    {
        $page = Site::pages()[$request->route()->getName()] ?? null;
        abort_if($page === null, 404);

        return view('page', ['page' => $page]);
    }

    public function sitemap(): Response
    {
        return response()->view('sitemap', ['pages' => Site::indexable() ? Site::pages() : []], 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $text = Site::indexable()
            ? "User-agent: *\nAllow: /\nSitemap: ".Site::url('/sitemap.xml')."\n"
            : "User-agent: *\nDisallow: /\n";

        return response($text)->header('Content-Type', 'text/plain');
    }
}
