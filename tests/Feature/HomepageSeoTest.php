<?php

use App\Support\Site;

it('renders search and social metadata for the homepage', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Physiotherapist in Kempton Park')
        ->assertSee('<meta name="description"', false)
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('<link rel="canonical" href="'.Site::url().'">', false)
        ->assertSee('<meta property="og:type" content="website">', false)
        ->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
});

it('uses a stable clinic identity and only confirmed structured location data', function () {
    config(['site.pages.about.published' => true, 'contact.practice.location_verified' => true, 'contact.practice.street' => 'Approved street', 'contact.practice.locality' => 'Kempton Park', 'contact.practice.region' => 'Gauteng', 'contact.practice.postcode' => '1619']);
    foreach (['/', '/about'] as $path) {
        $html = $this->get($path)->getContent();
        preg_match('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $html, $matches);
        $data = json_decode($matches[1], true, flags: JSON_THROW_ON_ERROR);
        $practice = collect($data['@graph'])->firstWhere('@type', 'MedicalClinic');
        expect($practice['@id'])->toBe(Site::url().'#practice')
            ->and($practice['medicalSpecialty'])->toBe('https://schema.org/Physiotherapy')
            ->and($practice['address']['streetAddress'])->toBe('Approved street')
            ->and($practice['address']['addressLocality'])->toBe('Kempton Park')
            ->and($practice)->not->toHaveKeys(['aggregateRating', 'review', 'openingHoursSpecification']);
    }
});

it('omits unconfirmed map and unsupported promotional claims', function () {
    config(['contact.practice.location_verified' => false, 'contact.practice.map_embed_url' => 'https://maps.example/196']);
    $this->get('/')->assertDontSee('maps.example')->assertDontSee('streetAddress')
        ->assertDontSee('Years combined experience')->assertDontSee('Sarah M.')
        ->assertDontSee('one business day')->assertDontSee('No referral needed');
});
