<?php

it('renders as a plain blade component with the mobile menu closed', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Danks')
        ->assertSee('Book an appointment')
        ->assertSee('data-mobile-menu-toggle', false)
        ->assertSee('aria-expanded="false"', false)
        ->assertSee('data-mobile-menu', false)
        ->assertSee('hidden', false);
});

it('uses the blade header component instead of livewire', function () {
    $layout = file_get_contents(resource_path('views/components/layouts/app.blade.php'));
    $header = file_get_contents(resource_path('views/components/site/header.blade.php'));

    expect($layout)
        ->toContain('<x-site.header />')
        ->not->toContain('<livewire:site.header />')
        ->and($header)
        ->not->toContain('Livewire\\')
        ->not->toContain('wire:click')
        ->not->toContain('wire:show');
});

it('provides client-side menu controls', function () {
    $javascript = file_get_contents(resource_path('js/app.js'));

    expect($javascript)
        ->toContain("toggle.addEventListener('click'")
        ->toContain("event.key === 'Escape'")
        ->toContain("document.body.classList.toggle('overflow-hidden', open)")
        ->toContain("window.matchMedia('(min-width: 1024px)')");
});
