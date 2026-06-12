<?php

use Livewire\Livewire;

it('renders nav and starts with the menu closed', function () {
    Livewire::test('site.header')
        ->assertSet('menuOpen', false)
        ->assertSee('Danks')
        ->assertSee('Book an appointment');
});

it('toggles the mobile menu and dispatches the browser event', function () {
    Livewire::test('site.header')
        ->call('toggleMenu')
        ->assertSet('menuOpen', true)
        ->assertDispatched('mobile-menu-toggled', open: true)
        ->call('toggleMenu')
        ->assertSet('menuOpen', false)
        ->assertDispatched('mobile-menu-toggled', open: false);
});

it('closes via the close-mobile-menu event', function () {
    Livewire::test('site.header')
        ->call('toggleMenu')
        ->assertSet('menuOpen', true)
        ->dispatch('close-mobile-menu')
        ->assertSet('menuOpen', false);
});
