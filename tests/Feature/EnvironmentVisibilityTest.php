<?php

use Illuminate\Support\Facades\Process;

it('opens every published page anonymously while keeping nonproduction out of search', function (string $environment, string $scheme) {
    app()->detectEnvironment(fn () => $environment);
    config(['site.indexable' => true, 'site.canonical_redirects' => true, 'app.url' => $scheme.'://preview.example.test']);
    foreach (array_merge(['/'], array_column(config('site.pages'), 'path')) as $path) {
        $this->get($scheme.'://preview.example.test'.$path)->assertSuccessful()
            ->assertHeaderMissing('WWW-Authenticate')->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
            ->assertDontSee('Missing optional information')->assertDontSee('data-content-placeholder', false);
    }
    $this->get('/robots.txt')->assertSuccessful()->assertSee('Disallow: /');
    $this->get('/sitemap.xml')->assertSuccessful()->assertDontSee('<loc>', false);
})->with(['local', 'staging'])->with(['http', 'https']);

it('keeps unpublished content unavailable in every environment without a preview bypass', function (string $environment) {
    app()->detectEnvironment(fn () => $environment);
    config(['site.pages.joint-muscle-pain.published' => false]);
    $this->get('/services/joint-muscle-pain?preview=true')->assertNotFound();
    $this->get('/services')->assertDontSee('href="'.route('joint-muscle-pain').'"', false);
})->with(['local', 'staging', 'production']);

it('keeps the deployment endpoint protected independently of website access', function (string $environment) {
    app()->detectEnvironment(fn () => $environment);
    Process::fake();
    config(['services.deploy.token' => 'synthetic-deploy-token']);
    $this->get('/deploy/wrong-token')->assertNotFound();
    config(['services.deploy.token' => '']);
    $this->get('/deploy/synthetic-deploy-token')->assertNotFound();
    Process::assertNothingRan();
})->with(['local', 'staging', 'production']);
