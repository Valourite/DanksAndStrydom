<?php

it('renders the treatment imagery across the homepage', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('images/back_strapping.webp')
        ->assertSee('images/knee_strapping.webp')
        ->assertSee('images/electrotherapy.webp')
        ->assertSee('images/valf_physio.webp');
});

it('uses treatment images with the required dimensions', function (string $image) {
    $path = public_path("images/{$image}");
    $dimensions = getimagesize($path);

    expect($path)->toBeFile()
        ->and($dimensions)->not->toBeFalse()
        ->and($dimensions[0])->toBe(1200)
        ->and($dimensions[1])->toBe(900);
})->with([
    'shoulder taping' => 'back_strapping.webp',
    'knee taping' => 'knee_strapping.webp',
    'electrotherapy' => 'electrotherapy.webp',
    'manual therapy' => 'valf_physio.webp',
]);
