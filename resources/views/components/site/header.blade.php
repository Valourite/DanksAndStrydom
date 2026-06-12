<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public bool $menuOpen = false;

    /** @var list<array{label: string, href: string}> */
    public array $nav = [
        ['label' => 'Home', 'href' => '#hero'],
        ['label' => 'Services', 'href' => '#services'],
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Testimonials', 'href' => '#testimonials'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];

    public function toggleMenu(): void
    {
        $this->menuOpen = ! $this->menuOpen;
        $this->dispatch('mobile-menu-toggled', open: $this->menuOpen);
    }

    #[On('close-mobile-menu')]
    public function closeMenu(): void
    {
        if ($this->menuOpen) {
            $this->menuOpen = false;
            $this->dispatch('mobile-menu-toggled', open: false);
        }
    }
}; ?>

<header
    data-site-header
    wire:keydown.escape.window="closeMenu"
    class="group/header fixed inset-x-0 top-0 z-50 border-b border-transparent transition-all duration-500
           [&.is-scrolled]:border-pine-900/8 [&.is-scrolled]:bg-bone-50/80 [&.is-scrolled]:shadow-[0_1px_0_0_rgba(10,31,27,0.04),0_12px_32px_-20px_rgba(10,31,27,0.25)] [&.is-scrolled]:backdrop-blur-xl"
>
    <nav class="mx-auto flex h-20 max-w-6xl items-center justify-between gap-4 px-5 sm:px-8 lg:h-24" aria-label="Primary">

        {{-- Wordmark --}}
        <a href="#hero" wire:click="closeMenu" class="flex items-center gap-3.5" aria-label="Danks &amp; Strydom Physiotherapy — home">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-pine-900/15 bg-bone-50 font-display text-[0.95rem] font-semibold tracking-tight text-pine-900">
                D<span class="text-sea-600">&amp;</span>S
            </span>
            <span class="leading-none">
                <span class="block font-display text-[1.05rem] font-medium tracking-tight text-pine-950 sm:text-lg">Danks &amp; Strydom</span>
                <span class="mt-1 block text-[0.62rem] font-semibold uppercase tracking-[0.28em] text-pine-500">Physiotherapy</span>
            </span>
        </a>

        {{-- Desktop nav --}}
        <ul class="absolute left-1/2 hidden -translate-x-1/2 items-center gap-7 lg:flex">
            @foreach ($nav as $item)
                <li>
                    <a href="{{ $item['href'] }}"
                       class="group/link relative py-2 text-[0.82rem] font-medium tracking-wide text-pine-700 transition-colors duration-200 hover:text-pine-950">
                        {{ $item['label'] }}
                        <span class="absolute inset-x-0 -bottom-px h-px origin-center scale-x-0 bg-sea-500 transition-transform duration-300 group-hover/link:scale-x-100"></span>
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Desktop CTA --}}
        <a href="#contact"
           class="hidden items-center gap-2.5 rounded-full bg-pine-900 py-2.5 pl-5 pr-2.5 text-[0.82rem] font-semibold text-bone-50 transition-all duration-300 hover:bg-sea-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-600 lg:inline-flex">
            Book an appointment
            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-bone-50/15">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </span>
        </a>

        {{-- Mobile toggle --}}
        <button
            type="button"
            wire:click="toggleMenu"
            aria-expanded="{{ $menuOpen ? 'true' : 'false' }}"
            aria-controls="mobile-menu"
            aria-label="{{ $menuOpen ? 'Close menu' : 'Open menu' }}"
            class="-mr-1 inline-flex h-12 w-12 items-center justify-center rounded-full text-pine-900 transition-colors hover:bg-pine-900/5 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-600 lg:hidden">
            {{-- Hamburger ↔ close, lines morph via CSS transforms --}}
            <span class="relative block h-4 w-6" aria-hidden="true">
                <span @class([
                    'absolute left-0 top-0 block h-px w-6 bg-current transition-all duration-300 ease-out',
                    'translate-y-[7.5px] rotate-45' => $menuOpen,
                ])></span>
                <span @class([
                    'absolute left-0 top-1/2 block h-px w-4 -translate-y-1/2 bg-current transition-all duration-300 ease-out',
                    'w-6 opacity-0' => $menuOpen,
                ])></span>
                <span @class([
                    'absolute bottom-0 left-0 block h-px w-6 bg-current transition-all duration-300 ease-out',
                    '-translate-y-[7.5px] -rotate-45' => $menuOpen,
                ])></span>
            </span>
        </button>
    </nav>

    {{-- Mobile menu panel --}}
    <div
        id="mobile-menu"
        wire:show="menuOpen"
        wire:transition.opacity.duration.300ms
        wire:cloak
        class="lg:hidden">
        <div class="border-t border-pine-900/8 bg-bone-50/95 px-5 pb-8 pt-4 shadow-2xl backdrop-blur-xl">
            <ul class="divide-y divide-pine-900/6">
                @foreach ($nav as $i => $item)
                    <li>
                        <a href="{{ $item['href'] }}"
                           wire:click="closeMenu"
                           class="flex items-center justify-between py-4 text-base font-medium text-pine-900 transition-colors hover:text-sea-700">
                            {{ $item['label'] }}
                            <span class="font-display text-xs italic text-pine-400">0{{ $i + 1 }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="#contact"
               wire:click="closeMenu"
               class="mt-5 flex items-center justify-center gap-2 rounded-full bg-pine-900 px-6 py-4 text-sm font-semibold text-bone-50 transition-colors hover:bg-sea-700">
                Book an appointment
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</header>
