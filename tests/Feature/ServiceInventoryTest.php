<?php

use App\Support\Site;

dataset('new service pages', [
    'joint-muscle-pain', 'mobility-movement-assessment', 'chronic-pain-management',
    'injury-prevention', 'rehabilitation-exercise-programmes',
]);

it('can unpublish a service without exposing it through preview queries or the sitemap', function (string $name) {
    app()->detectEnvironment(fn () => 'production');
    config(['site.indexable' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    $path = '/services/'.$name;
    config(["site.pages.$name.published" => false]);
    $this->get($path.'?preview=true')->assertNotFound();
    $this->get('/services')->assertDontSee('href="'.route($name).'"', false);
    $this->get('/sitemap.xml')->assertDontSee('<loc>'.Site::url($path).'</loc>', false);
    config(["site.pages.$name.published" => true]);
    $response = $this->get($path)->assertOk()->assertSee(config("site.pages.$name.heading"))
        ->assertSee('<link rel="canonical" href="'.Site::url($path).'">', false)
        ->assertSee('content="'.e(config("site.pages.$name.description")).'"', false);
    expect(substr_count($response->getContent(), '<h1'))->toBe(1);
    $this->get('/services')->assertSee('href="'.route($name).'"', false);
    $this->get('/sitemap.xml')->assertSee('<loc>'.Site::url($path).'</loc>', false);
})->with('new service pages');

it('offers eight ordered crawlable staging cards with matching icons and unique page metadata', function () {
    app()->detectEnvironment(fn () => 'staging');
    $expected = [
        'sports-injury-rehabilitation' => 'pulse', 'back-neck-pain' => 'spine', 'post-operative-rehabilitation' => 'recovery',
        'joint-muscle-pain' => 'joint', 'mobility-movement-assessment' => 'mobility', 'chronic-pain-management' => 'chronic',
        'injury-prevention' => 'shield', 'rehabilitation-exercise-programmes' => 'program',
    ];
    $html = $this->get('https://staging.example.test/services')->assertOk()->getContent();
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $links = $xpath->query('//*[@data-service-cards]//article/a');
    expect($links->length)->toBe(8);
    $titles = $descriptions = [];
    foreach (array_keys($expected) as $index => $name) {
        $path = config("site.pages.$name.path");
        expect($links->item($index)->getAttribute('href'))->toBe(route($name))
            ->and(config("site.pages.$name.service_icon"))->toBe($expected[$name]);
        $page = $this->get('https://staging.example.test'.$path)->assertOk()->assertHeader('X-Robots-Tag', 'noindex, nofollow')->getContent();
        preg_match('/<title>(.*?)<\/title>/', $page, $title);
        $titles[] = $title[1];
        $descriptions[] = config("site.pages.$name.description");
    }
    expect(array_unique($titles))->toHaveCount(8)->and(array_unique($descriptions))->toHaveCount(8);
    $this->get('https://staging.example.test/sitemap.xml')->assertDontSee('<loc>', false);
});

it('limits related services to relevant published destinations', function () {
    config(['site.pages.joint-muscle-pain.published' => true, 'site.pages.mobility-movement-assessment.published' => false, 'site.pages.back-neck-pain.published' => false]);
    $this->get('/services/joint-muscle-pain')->assertOk()->assertDontSee('aria-label="Related services"', false);
    config(['site.pages.mobility-movement-assessment.published' => true]);
    $this->get('/services/joint-muscle-pain')->assertSee('href="'.route('mobility-movement-assessment').'"', false)
        ->assertDontSee('href="'.route('chronic-pain-management').'"', false)
        ->assertDontSee('href="'.route('back-neck-pain').'"', false);
});
