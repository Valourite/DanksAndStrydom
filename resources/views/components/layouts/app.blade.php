@props([
    'title' => null,
    'description' => 'Personalised, evidence-informed physiotherapy, rehabilitation, and movement care from Danks & Strydom Physiotherapy.',
    'canonical' => null,
    'image' => null,
    'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
])

@php
    $practice = config('contact.practice');
    $siteName = $practice['name'] ?? config('app.name');
    $pageTitle = $title ? "{$title} | {$siteName}" : $siteName;
    $canonicalUrl = $canonical ?: route('home');
    $socialImage = $image ?: asset('images/back_strapping.webp');

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => "{$canonicalUrl}#website",
                'url' => $canonicalUrl,
                'name' => $siteName,
                'inLanguage' => str_replace('_', '-', app()->getLocale()),
            ],
            [
                '@type' => 'Physiotherapy',
                '@id' => "{$canonicalUrl}#practice",
                'name' => $siteName,
                'url' => $canonicalUrl,
                'description' => $description,
                'image' => $socialImage,
                'telephone' => $practice['phone'],
                'email' => $practice['email'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $practice['address'],
                    'addressCountry' => 'ZA',
                ],
                'medicalSpecialty' => 'https://schema.org/Physiotherapy',
                'openingHoursSpecification' => [
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => [
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday',
                        ],
                        'opens' => '07:30',
                        'closes' => '17:30',
                    ],
                ],
                'hasMap' => 'https://www.google.com/maps/search/?api=1&query='.urlencode($practice['address']),
            ],
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fbfaf7">
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $robots }}">

    <title>{{ $pageTitle }}</title>

    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="sitemap" type="application/xml" href="{{ asset('sitemap.xml') }}">
    <link rel="preload" as="image" href="{{ $socialImage }}" fetchpriority="high">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="900">
    <meta property="og:image:alt" content="Physiotherapy treatment at {{ $siteName }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $socialImage }}">

    <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
    </script>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-bone-50 font-sans text-pine-900 selection:bg-sea-200 selection:text-pine-950">

    <a href="#main"
       class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100 focus:rounded-full focus:bg-pine-900 focus:px-5 focus:py-2 focus:text-sm focus:font-semibold focus:text-bone-50 focus:shadow-lg">
        Skip to content
    </a>

    <x-site.header />

    <main id="main">
        {{ $slot }}
    </main>

    <x-site.footer />

    @livewireScripts
</body>
</html>
