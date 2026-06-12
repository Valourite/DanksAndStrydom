<?php

it('renders search and social metadata for the homepage', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('<title>Physiotherapy &amp; Rehabilitation | Danks &amp; Strydom Physiotherapy</title>', false)
        ->assertSee('<meta name="description"', false)
        ->assertSee('<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">', false)
        ->assertSee('<link rel="canonical" href="'.route('home').'">', false)
        ->assertSee('<meta property="og:type" content="website">', false)
        ->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
});

it('renders valid local physiotherapy structured data', function () {
    $response = $this->get('/');
    $content = $response->getContent();

    preg_match('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $content, $matches);

    $structuredData = json_decode($matches[1] ?? '', true, flags: JSON_THROW_ON_ERROR);
    $practice = collect($structuredData['@graph'])->firstWhere('@type', 'Physiotherapy');

    expect($practice)
        ->not->toBeNull()
        ->and($practice['name'])->toBe(config('contact.practice.name'))
        ->and($practice['address']['streetAddress'])->toBe(config('contact.practice.address'))
        ->and($practice['telephone'])->toBe(config('contact.practice.phone'))
        ->and($practice['medicalSpecialty'])->toBe('https://schema.org/Physiotherapy');
});

it('publishes crawl discovery files', function () {
    expect(public_path('sitemap.xml'))
        ->toBeFile()
        ->and(file_get_contents(public_path('sitemap.xml')))
        ->toContain('<loc>https://danksandstrydom.co.za/</loc>')
        ->and(file_get_contents(public_path('robots.txt')))
        ->toContain('Sitemap: https://danksandstrydom.co.za/sitemap.xml');
});
