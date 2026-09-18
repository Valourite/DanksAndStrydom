<?php

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

foreach (config('site.pages') as $name => $page) {
    Route::get($page['path'], [SiteController::class, 'page'])->name($name);
}
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SiteController::class, 'robots'])->name('robots');

Route::get('/deploy/{token}', function (Request $request, $token) {
    $configuredToken = (string) config('services.deploy.token');
    $providedToken = (string) $token;

    abort_if($configuredToken === '', 404);

    abort_unless(
        hash_equals($configuredToken, $providedToken),
        404
    );

    $result = Process::timeout(600)->run(
        '/bin/bash /home/danks/repositories/DanksAndStrydom/deploy.sh'
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
