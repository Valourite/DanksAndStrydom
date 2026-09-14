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
    $canonicalUrl = $canonical ?: \App\Support\Site::url(request()->path() === '/' ? '/' : '/'.request()->path());
    $rootUrl = \App\Support\Site::url();
    $robots = \App\Support\Site::indexable() ? $robots : 'noindex, nofollow';
    $socialImage = $image ?: \App\Support\Site::url('/images/back_strapping.webp');

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => "{$rootUrl}#website",
                'url' => $rootUrl,
                'name' => $siteName,
                'inLanguage' => str_replace('_', '-', app()->getLocale()),
            ],
            [
                '@type' => 'MedicalClinic',
                '@id' => "{$rootUrl}#practice",
                'name' => $siteName,
                'url' => $rootUrl,
                'description' => 'Danks & Strydom Physiotherapy in Glen Marais, Kempton Park.',
                'image' => $socialImage,
                'telephone' => $practice['phone'],
                'email' => $practice['email'],
                'medicalSpecialty' => 'https://schema.org/Physiotherapy',
            ],
        ],
    ];
    $clinic = &$structuredData['@graph'][1];
    foreach (['telephone', 'email'] as $field) {
        if (empty($clinic[$field])) { unset($clinic[$field]); }
    }
    if ($practice['location_verified']) {
        $clinic['address'] = array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $practice['street'],
            'addressLocality' => $practice['locality'],
            'addressRegion' => $practice['region'],
            'postalCode' => $practice['postcode'],
            'addressCountry' => $practice['country'],
        ]);
        if ($practice['directions_url']) { $clinic['hasMap'] = $practice['directions_url']; }
    }

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#FAFCFE">
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $robots }}">

    <title>{{ $pageTitle }}</title>

    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="sitemap" type="application/xml" href="{{ \App\Support\Site::url('/sitemap.xml') }}">
    @if (request()->routeIs('home'))
    <link rel="preload" as="image" href="{{ $socialImage }}" fetchpriority="high">
    @endif

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
<body data-analytics-enabled="{{ config('site.analytics_enabled') ? 'true' : 'false' }}" class="min-h-screen bg-surface-50 font-sans text-ink-900 selection:bg-accent-200 selection:text-ink-900">

    <a href="#main"
       class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100 focus:rounded-full focus:bg-brand focus:px-5 focus:py-2 focus:text-sm focus:font-semibold focus:text-white focus:shadow-lg focus:shadow-navy/25">
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
