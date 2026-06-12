@props([
    'title' => null,
    'description' => 'Danks & Strydom Physiotherapy — personalised, evidence-informed physiotherapy care to help you move, recover, and feel better.',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fbfaf7">
    <meta name="description" content="{{ $description }}">

    <title>{{ $title ? $title.' — ' : '' }}{{ config('contact.practice.name', config('app.name')) }}</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-bone-50 font-sans text-pine-900 selection:bg-sea-200 selection:text-pine-950">

    <a href="#main"
       class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100 focus:rounded-full focus:bg-pine-900 focus:px-5 focus:py-2 focus:text-sm focus:font-semibold focus:text-bone-50 focus:shadow-lg">
        Skip to content
    </a>

    <livewire:site.header />

    <main id="main">
        {{ $slot }}
    </main>

    <x-site.footer />

    @livewireScripts
</body>
</html>
