<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/deploy/{token}', function ($token) {
    if(!env('DEPLOY_TOKEN') || $token !== env('DEPLOY_TOKEN')) {
        //Capture the deploy attempt in logs for awareness, but don't reveal the token or any details.
        \Log::warning('Unauthorized deploy attempt detected.', [
            'ip' => request()->ip(), 
            'user_agent' => request()->userAgent(), 
            'timestamp' => now()->toDateTimeString()
            ]);

        abort(403, 'You shouldn\'t be here.');
    }

    // 1. Run Migrations & Clear Cache
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('optimize:clear');

    // 2. Cache the files again
    Artisan::call('optimize');

    // 2. Fix Storage Link (The Custom Fix)
    // We point to the 'public_html' folder using $_SERVER['DOCUMENT_ROOT']
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    if (!file_exists($linkFolder)) {
        symlink($targetFolder, $linkFolder);
        $storageStatus = 'Storage link created successfully.';
    } else {
        $storageStatus = 'Storage link already exists.';
    }

    return "Deployment completed.<br>Migrations run.<br>Cache cleared.<br>{$storageStatus}";
});
