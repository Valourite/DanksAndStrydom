<?php

use App\Support\Site;

it('renders each published page with distinct initial HTML metadata', function () {
    foreach (array_keys(config('site.pages')) as $name) {
        config(["site.pages.$name.published" => true]);
    }
    $titles = [];
    foreach (['/' => 'home', '/about' => 'about', '/contact' => 'contact', '/services' => 'services', '/services/back-neck-pain' => 'back-neck-pain', '/services/sports-injury-rehabilitation' => 'sports-injury-rehabilitation', '/services/post-operative-rehabilitation' => 'post-operative-rehabilitation', '/patient-information' => 'patient-information'] as $path => $name) {
        $html = $this->get($path)->assertSuccessful()->getContent();
        expect(substr_count($html, '<h1'))->toBe(1)
            ->and(substr_count($html, '<title>'))->toBe(1)
            ->and($html)->toContain('<link rel="canonical" href="'.Site::url($path).'">');
        preg_match('/<title>(.*?)<\/title>/', $html, $match);
        $titles[] = $match[1];
    }
    expect(array_unique($titles))->toHaveCount(8);
});

it('keeps drafts and unknown paths unavailable even with preview query strings', function (string $path) {
    foreach (['back-neck-pain', 'sports-injury-rehabilitation', 'post-operative-rehabilitation', 'patient-information'] as $name) {
        config(["site.pages.$name.published" => false]);
    }
    $this->get($path.'?preview=true')->assertNotFound();
})->with(['/services/back-neck-pain', '/services/sports-injury-rehabilitation', '/services/post-operative-rehabilitation', '/patient-information', '/services/mckenzie-assessment', '/serengeti', '/missing']);

it('publishes only approved canonical pages in the production sitemap', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.indexable' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    config(['site.pages.back-neck-pain.published' => false, 'site.pages.patient-information.published' => false]);
    $this->get('/services')->assertDontSee('href="'.route('back-neck-pain').'"', false);
    $xml = $this->get('/sitemap.xml')->assertSuccessful()->getContent();
    expect(simplexml_load_string($xml))->not->toBeFalse();
    foreach (['/', '/services', '/contact'] as $path) {
        expect($xml)->toContain('<loc>'.Site::url($path).'</loc>');
    }
    expect($xml)->not->toContain('back-neck-pain', 'patient-information', 'lastmod');
    $this->get('/robots.txt')->assertSee('Sitemap: https://danksandstrydom.co.za/sitemap.xml');
});

it('keeps nonproduction out of search even when indexing is configured', function () {
    config(['site.indexable' => true]);
    $this->get('/')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    $this->get('/robots.txt')->assertSee('Disallow: /');
    $this->get('/sitemap.xml')->assertDontSee('<loc>', false);
});

it('redirects known production variants once with path and query intact', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.canonical_redirects' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    $this->get('http://www.danksandstrydom.co.za/contact?utm_source=test&x=1')
        ->assertStatus(301)->assertRedirect('https://danksandstrydom.co.za/contact?utm_source=test&x=1');
    $this->get('https://danksandstrydom.co.za/contact')->assertSuccessful();
    $this->get('https://danksandstrydom.co.za/missing')->assertNotFound();
});

it('does not send staging or development to production or trust arbitrary hosts', function () {
    config(['site.canonical_redirects' => true, 'app.url' => 'https://danksandstrydom.co.za']);
    $this->get('http://localhost/contact')->assertSuccessful();
    app()->detectEnvironment(fn () => 'production');
    $this->get('https://staging.example.test/contact')->assertSuccessful();
    $this->get('https://attacker.example/contact?private=value')
        ->assertSee('<link rel="canonical" href="https://danksandstrydom.co.za/contact">', false);
});

it('publishes a service link and sitemap entry only after explicit approval', function () {
    config(['site.pages.back-neck-pain.published' => true, 'site.indexable' => true]);
    app()->detectEnvironment(fn () => 'production');
    $this->get('/services/back-neck-pain')->assertSuccessful()->assertSee('Back and neck pain');
    $this->get('/')->assertSee('href="'.route('back-neck-pain').'"', false);
    $this->get('/sitemap.xml')->assertSee(Site::url('/services/back-neck-pain'));
});

it('provides a direct enquiry without an empty service grid or explore self-link', function () {
    foreach (['back-neck-pain', 'sports-injury-rehabilitation', 'post-operative-rehabilitation'] as $name) {
        config(["site.pages.$name.published" => false]);
    }
    foreach (['/', '/services'] as $path) {
        $this->get($path)->assertSuccessful()->assertSee('data-service-enquiry', false)
            ->assertSee('href="'.route('contact').'#contact"', false)
            ->assertDontSee('data-service-cards', false)->assertDontSee('Explore physiotherapy enquiries');
    }
});

it('automatically shows only published services without an explore self-link', function () {
    config(['site.pages.back-neck-pain.published' => true, 'site.pages.sports-injury-rehabilitation.published' => true, 'site.pages.post-operative-rehabilitation.published' => false]);
    $this->get('/services')->assertSuccessful()->assertSee('data-service-cards', false)
        ->assertSee('href="'.route('back-neck-pain').'"', false)
        ->assertSee('href="'.route('sports-injury-rehabilitation').'"', false)
        ->assertDontSee('href="'.route('post-operative-rehabilitation').'"', false)
        ->assertDontSee('data-service-enquiry', false)->assertDontSee('Explore physiotherapy enquiries');
});

it('renders complete review copy when its pages are explicitly approved', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.indexable' => true]);
    config(['site.pages.about.published' => true]);
    foreach (['back-neck-pain', 'sports-injury-rehabilitation', 'post-operative-rehabilitation', 'patient-information'] as $name) {
        config(["site.pages.$name.published" => true]);
        $this->get(route($name))->assertSuccessful()
            ->assertSee('Patients are not expected to bring anything')->assertDontSee('Placeholder');
        $this->get('/sitemap.xml')->assertSee(Site::url(config("site.pages.$name.path")));
    }
    $this->get('/about')->assertSee('Elize Strydom')->assertSee('Cheryl Myburgh')
        ->assertSee('Physiotherapist')->assertDontSee('Placeholder');
});

it('shows the supplied contact address while keeping unverified maps and schema gated', function () {
    config(['contact.practice.location_verified' => false, 'contact.practice.address' => 'Surgiklin Studios, Unit 12, Koorsboom Ave, Glen Marais, Kempton Park, 1619', 'contact.practice.phone' => '011 391 3126', 'contact.practice.email' => 'admin@danksandstrydom.co.za']);
    $this->get('/contact')->assertSuccessful()->assertSee('Surgiklin Studios, Unit 12, Koorsboom Ave')
        ->assertSee('011 391 3126')->assertSee('admin@danksandstrydom.co.za')
        ->assertDontSee('Practice location map')->assertDontSee('streetAddress')->assertDontSee('Monument Road');
});
