<?php

use App\Support\Site;

it('ships correctly sized responsive illustrations within a web image budget', function () {
    foreach (config('imagery.images') as $photo) {
        foreach ($photo['variants'] as $width => $path) {
            $file = public_path($path);
            expect($file)->toBeFile();
            $dimensions = getimagesize($file);
            expect($dimensions[0])->toBe($width)
                ->and($dimensions[1])->toBe((int) ($width * $photo['height'] / $photo['width']))
                ->and($dimensions['mime'])->toBe('image/webp')
                ->and(filesize($file))->toBeLessThan(160000);
        }
    }
});

it('uses page specific heroes and accurate illustrative social metadata on every public page', function () {
    foreach (config('imagery.pages') as $path => $key) {
        $photo = config('imagery.images.'.$key);
        $response = $this->get($path)->assertSuccessful()
            ->assertSee('src="'.asset($photo['path']).'"', false)
            ->assertSee('width="'.$photo['width'].'" height="'.$photo['height'].'"', false)
            ->assertSee('<meta property="og:image" content="'.Site::url('/'.$photo['path']).'">', false)
            ->assertSee('<meta property="og:image:alt" content="'.$photo['alt'].'">', false)
            ->assertSee('<meta property="og:image:width" content="'.$photo['width'].'">', false)
            ->assertSee('<meta property="og:image:height" content="'.$photo['height'].'">', false)
            ->assertSee('Images are AI-generated illustrations')
            ->assertDontSee('Physiotherapy treatment at');
        $dom = new DOMDocument;
        @$dom->loadHTML($response->getContent());
        $xpath = new DOMXPath($dom);
        expect($xpath->query('//img[@fetchpriority="high"]')->length)->toBe(1);
        $hero = $xpath->query('//img[@fetchpriority="high"]')->item(0);
        expect($hero->getAttribute('loading'))->toBe('eager');
        foreach ($photo['variants'] as $width => $variant) {
            expect($hero->getAttribute('srcset'))->toContain(asset($variant).' '.$width.'w');
        }
        $data = json_decode($xpath->query('//script[@type="application/ld+json"]')->item(0)->textContent, true, flags: JSON_THROW_ON_ERROR);
        expect(collect($data['@graph'])->firstWhere('@type', 'MedicalClinic'))->not->toHaveKey('image');
        if ($path === '/') {
            $preload = $xpath->query('//link[@rel="preload" and @as="image"]')->item(0);
            expect($preload->getAttribute('href'))->toBe($hero->getAttribute('src'))
                ->and($preload->getAttribute('imagesrcset'))->toBe($hero->getAttribute('srcset'))
                ->and($preload->getAttribute('imagesizes'))->toBe($hero->getAttribute('sizes'));
            $images = $xpath->query('//img');
            $sources = [];
            foreach ($images as $image) {
                $sources[] = $image->getAttribute('src');
                if ($image !== $hero && $image->getAttribute('fetchpriority') !== 'high') {
                    expect($image->getAttribute('loading'))->toBe('lazy');
                }
            }
            expect(array_unique($sources))->toHaveCount(7)->and($sources)->toHaveCount(7);
        }
    }
});
