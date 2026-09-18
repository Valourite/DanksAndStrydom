<?php

it('withholds the mixed human and equine gallery pending scope and image approval', function () {
    $this->get('/')->assertSuccessful()
        ->assertDontSee('data-image-carousel', false)
        ->assertDontSee('images/cheryl-horse-1.webp');
});

it('retains gallery assets for factual review', function () {
    foreach (['cheryl-horse-1.webp', 'cheryl-horse-2.webp', 'elize-horse-1.webp', 'elize-messsage-1.webp', 'elize-physio-1.webp', 'elize-physio-2.webp', 'physios-massage-1.webp'] as $image) {
        expect(public_path('images/'.$image))->toBeFile();
    }
});
