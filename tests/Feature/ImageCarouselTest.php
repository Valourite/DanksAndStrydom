<?php

it('renders the desktop image carousel and lightbox', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('data-image-carousel', false)
        ->assertSee('data-carousel-dialog', false)
        ->assertSee('hidden md:block', false)
        ->assertSee('images/cheryl-horse-1.webp')
        ->assertSee('images/physios-massage-1.webp');
});

it('renders every gallery image twice for a seamless loop', function () {
    $response = $this->get('/');

    foreach ([
        'cheryl-horse-1.webp',
        'cheryl-horse-2.webp',
        'elize-horse-1.webp',
        'elize-messsage-1.webp',
        'elize-physio-1.webp',
        'elize-physio-2.webp',
        'physios-massage-1.webp',
    ] as $image) {
        expect(substr_count($response->getContent(), "images/{$image}"))->toBe(4);
    }
});
