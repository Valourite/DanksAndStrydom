<?php

it('shows three labelled design samples only on local and staging in the requested order', function (string $environment) {
    app()->detectEnvironment(fn () => $environment);
    config(['site.testimonials.entries' => []]);
    $html = $this->get('/')->assertSuccessful()->assertHeader('X-Robots-Tag', 'noindex, nofollow')
        ->assertSeeInOrder(['data-practice-images', 'What our patients say', 'Meet the people behind your care'])
        ->assertDontSee('Read original testimonial')->getContent();
    expect(substr_count($html, 'Sample testimonial — replace before publishing'))->toBe(3);
    expect(explode('</head>', $html)[0])->not->toContain('Sample testimonial', 'Reviewer display name', 'aggregateRating', '"@type":"Review"');
})->with(['local', 'staging']);

it('omits the entire section outside local and staging when there are no approved entries', function (string $environment) {
    app()->detectEnvironment(fn () => $environment);
    config(['site.testimonials.entries' => [], 'site.testimonials.samples.0.approved' => true]);
    $html = $this->get('/?preview=true')->assertSuccessful()->assertDontSee('id="testimonials"', false)
        ->assertDontSee('What our patients say')->assertDontSee('Sample testimonial')->getContent();
    foreach (config('site.testimonials.samples') as $sample) {
        expect($html)->not->toContain($sample['quote'], $sample['display_name']);
    }
})->with(['production', 'testing', 'preview']);

it('renders only explicitly approved complete entries and keeps all quotes out of metadata and schema', function () {
    app()->detectEnvironment(fn () => 'production');
    config(['site.testimonials.entries' => [
        ['quote' => 'Synthetic approved <script>quote</script>', 'display_name' => 'Synthetic <name>', 'source_url' => 'https://example.test/review', 'approved' => true],
        ['quote' => 'Synthetic no-source quote', 'display_name' => 'Synthetic no-source name', 'source_url' => null, 'approved' => true],
        ['quote' => 'Unapproved sentinel', 'display_name' => 'Draft name', 'approved' => false],
        ['quote' => 'String approval sentinel', 'display_name' => 'Draft name', 'approved' => 'true'],
        ['quote' => 'Missing approval sentinel', 'display_name' => 'Draft name'],
        ['quote' => 'Incomplete sentinel', 'display_name' => ' ', 'approved' => true],
    ]]);
    $html = $this->get('/')->assertSuccessful()->assertSee('What our patients say')
        ->assertSee('Synthetic approved <script>quote</script>')->assertSee('Synthetic <name>')
        ->assertDontSee('<script>quote</script>', false)->assertSee('href="https://example.test/review"', false)
        ->assertDontSee('Unapproved sentinel')->assertDontSee('String approval sentinel')->assertDontSee('Missing approval sentinel')
        ->assertDontSee('Incomplete sentinel')->assertDontSee('Sample testimonial')->assertDontSee('out of 5 stars')->getContent();
    expect(substr_count($html, 'Read original testimonial'))->toBe(1);
    expect(explode('</head>', $html)[0])->not->toContain('Synthetic', 'aggregateRating', '"@type":"Review"');
});

it('never renders unsafe or invalid source links', function (string $source) {
    app()->detectEnvironment(fn () => 'production');
    config(['site.testimonials.entries' => [['quote' => 'Synthetic quote', 'display_name' => 'Synthetic name', 'source_url' => $source, 'approved' => true]]]);
    $this->get('/')->assertSee('Synthetic quote')->assertDontSee('Read original testimonial')->assertDontSee('href="'.$source.'"', false);
})->with(['javascript:alert(1)', 'not-a-url', '//example.test/review', '']);

it('uses approved entries instead of filling staging with sample cards', function () {
    app()->detectEnvironment(fn () => 'staging');
    config(['site.testimonials.entries' => [['quote' => 'Synthetic approved quote', 'display_name' => 'Synthetic name', 'approved' => true]]]);
    $this->get('/')->assertSee('Synthetic approved quote')->assertDontSee('Sample testimonial');
});

it('publishes the three user-confirmed testimonials without samples ratings or invented source links', function (string $environment) {
    app()->detectEnvironment(fn () => $environment);
    $html = $this->get('/')->assertSuccessful()->assertSeeInOrder(['Sarah M.', 'Priya N.', 'Lerato K.'])
        ->assertSee('After months of lower back pain, I finally feel like myself again.')
        ->assertSee('The guidance after my surgery was clear and reassuring at every step.')
        ->assertSee('What stood out was how much they listened.')
        ->assertDontSee('Sample testimonial')->assertDontSee('Reviewer display name')
        ->assertDontSee('Read original testimonial')->assertDontSee('out of 5 stars')->getContent();
    expect(config('site.testimonials.entries'))->toHaveCount(3);
    expect(explode('</head>', $html)[0])->not->toContain('Sarah M.', 'Priya N.', 'Lerato K.', 'aggregateRating', '"@type":"Review"');
})->with(['local', 'staging', 'production']);
