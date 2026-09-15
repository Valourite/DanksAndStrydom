<?php

use App\Support\Site;

it('publishes the complete inventory to unauthenticated production visitors and the indexable sitemap', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.indexable' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    $xml = $this->get('/sitemap.xml')->assertSuccessful()->getContent();
    expect(simplexml_load_string($xml)->url)->toHaveCount(13);
    foreach (config('site.pages') as $name => $page) {
        expect($page['published'])->toBeTrue();
        $html = $this->get($page['path'].'?preview=true')->assertSuccessful()
            ->assertSee($page['heading'])->assertDontSee('data-content-placeholder', false)
            ->assertSee('<link rel="canonical" href="'.Site::url($page['path']).'">', false)
            ->assertSee('<meta name="robots" content="index, follow', false)->getContent();
        expect($xml)->toContain('<loc>'.Site::url($page['path']).'</loc>');
        expect(substr_count($html, '<h1'))->toBe(1);
    }
    foreach (['/', '/services'] as $path) {
        $html = $this->get($path)->assertSuccessful()->getContent();
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $links = (new DOMXPath($dom))->query('//*[@data-service-cards]//article/a');
        expect($links->length)->toBe(8);
        foreach (array_keys(Site::services()) as $index => $name) {
            expect($links->item($index)->getAttribute('href'))->toBe(route($name));
        }
    }
    $this->get('/contact')->assertSee('Walk-ins can be accommodated only')->assertSee('Arranging an appointment');
});

it('hides unknown optional fields and incomplete photos without hiding confirmed practitioner information', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.pages.about.practitioners.0.photo.path' => 'images/back_strapping.webp', 'site.pages.about.practitioners.0.languages' => ['', '   ']]);
    $this->get('/about?preview=true')->assertSuccessful()
        ->assertSee('Cheryl Myburgh')->assertSee('Elize Strydom')->assertSee('both hold degrees in physiotherapy')
        ->assertSee('extensive experience in human and equine physiotherapy')
        ->assertDontSee('data-practitioner-field', false)->assertDontSee('data-practitioner-photo', false)
        ->assertDontSee('Missing optional information:');
    $this->get('/patient-information')->assertSee('Cash and card payments are accepted')
        ->assertDontSee('Current consultation fees')->assertDontSee('Missing optional information:');
});

it('renders supplied optional facts as escaped body content without adding them to metadata or schema', function () {
    app()->detectEnvironment(fn () => 'production');
    config([
        'site.pages.about.practitioners.0.qualifications' => ['Test qualification <script>sentinel</script>'],
        'site.pages.about.practitioners.0.universities' => ['Test university'],
        'site.pages.about.practitioners.0.expanded_biography' => 'Test expanded biography.',
        'site.pages.about.practitioners.0.languages' => ['Test language'],
        'site.pages.about.practitioners.0.photo' => ['path' => 'images/back_strapping.webp', 'alt' => 'Synthetic test portrait'],
        'site.pages.patient-information.optional_sections.payment_timing.body' => 'Test payment timing.',
    ]);
    $html = $this->get('/about')->assertSee('Test qualification <script>sentinel</script>')
        ->assertSee('Test university')->assertSee('Test expanded biography.')->assertSee('Test language')
        ->assertSee('data-practitioner-photo', false)->assertSee('Synthetic test portrait')
        ->assertDontSee('<script>sentinel</script>', false)->getContent();
    $head = explode('</head>', $html)[0];
    expect($head)->not->toContain('Test qualification', 'Test university', 'Test expanded biography', 'Test language', 'Synthetic test portrait');
    $this->get('/patient-information')->assertSee('When payment is due')->assertSee('Test payment timing.');
});
