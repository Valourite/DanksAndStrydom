@php
    $isService = str_starts_with($page['path'], '/services/');
    $pageImage = match ($page['path']) {
        '/services/back-neck-pain' => 'back_strapping.webp',
        '/services/sports-injury-rehabilitation', '/services/post-operative-rehabilitation' => 'knee_strapping.webp',
        default => 'valf_physio.webp',
    };
    $sections = $page['sections'] + (\App\Support\Site::reviewing() ? ($page['review_sections'] ?? []) : []);
@endphp
<x-layouts.app :title="$page['title']" :description="$page['description']" :canonical="\App\Support\Site::url($page['path'])">
    <section class="relative isolate overflow-hidden pb-20 pt-32 sm:pt-40 lg:pb-28 lg:pt-48">
        <div class="absolute inset-0 -z-20 bg-linear-to-b from-bone-100 via-bone-50 to-bone-50"></div>
        <div class="pointer-events-none absolute -right-40 -top-24 -z-10 h-136 w-136 rounded-full bg-sea-100/70 blur-3xl"></div>
        <div class="mx-auto grid max-w-6xl items-center gap-14 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-20">
            <div class="reveal max-w-xl">
                <a href="{{ route('home') }}" class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-700 underline underline-offset-4">Danks &amp; Strydom · Home</a>
                <h1 class="mt-7 text-balance font-display text-[2.7rem] font-medium leading-[1.06] tracking-tight text-pine-950 sm:text-6xl lg:text-[4.1rem]">{{ $page['heading'] }}</h1>
                <p class="mt-7 max-w-md text-pretty text-base leading-relaxed text-pine-600 sm:text-lg">{{ $page['intro'] }}</p>
                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a href="{{ route('contact') }}#contact" class="inline-flex items-center justify-center rounded-full bg-pine-900 px-7 py-3.5 text-sm font-semibold text-bone-50 shadow-[0_18px_40px_-18px_rgba(10,31,27,0.6)] hover:bg-sea-700">Request an appointment</a>
                    <x-site.phone />
                </div>
            </div>
            <div class="reveal relative mx-auto w-full max-w-sm lg:max-w-none">
                <div class="absolute -right-6 top-10 hidden h-72 w-52 rounded-t-full bg-sand-200/80 sm:block" aria-hidden="true"></div>
                <figure class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-pine-950 shadow-[0_40px_80px_-40px_rgba(10,31,27,0.7)]">
                    <div class="relative h-72 overflow-hidden sm:h-80 lg:h-88">
                        <img src="{{ asset('images/'.$pageImage) }}" alt="Physiotherapy treatment illustration" width="1200" height="900" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-linear-to-t from-pine-950 via-pine-950/5 to-transparent"></div>
                    </div>
                    <figcaption class="relative -mt-6 px-8 pb-9 font-display text-2xl leading-snug text-bone-50">Danks &amp; Strydom<br><em class="text-sea-300">Glen Marais, Kempton Park.</em></figcaption>
                </figure>
            </div>
        </div>
    </section>
    @if (request()->routeIs('services')) @include('sections.services') @endif
    @if (! empty($page['practitioners']))
        <section class="grain relative overflow-hidden bg-pine-950 py-20 text-bone-50 sm:py-28">
            <div class="mx-auto max-w-6xl px-5 sm:px-8">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-sea-300">Your physiotherapists</p>
                <div class="mt-10 grid gap-12 md:grid-cols-2 md:gap-20">
                    @foreach ($page['practitioners'] as $practitioner)
                        <section data-practitioner class="border-t border-bone-50/20 pt-8">
                            <h2 class="font-display text-3xl font-medium sm:text-4xl">{{ $practitioner['name'] }}</h2>
                            <p class="mt-4 text-sm font-semibold text-sea-300">{{ $practitioner['title'] }}</p>
                            <p class="mt-6 max-w-md text-base leading-relaxed text-pine-200">{{ $practitioner['biography'] }}</p>
                        </section>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if ($sections !== [])
        <section class="relative py-20 sm:py-28">
            <div class="mx-auto grid max-w-6xl gap-12 px-5 sm:px-8 lg:grid-cols-[0.65fr_1.35fr] lg:gap-20">
                <div class="lg:sticky lg:top-32 lg:self-start">
                    <x-site.section-heading eyebrow="{{ $isService ? 'Your care' : 'Good to know' }}" align="left" title="{{ $isService ? 'Your appointment, step by step' : 'Information for your visit' }}" />
                    @if ($isService && isset(\App\Support\Site::pages()['patient-information']))
                        <a href="{{ route('patient-information') }}" class="mt-8 inline-flex text-sm font-semibold text-sea-700 underline underline-offset-4">Fees, bookings and patient information</a>
                    @endif
                </div>
                <div class="divide-y divide-pine-900/10 border-y border-pine-900/10">
                    @foreach ($sections as $heading => $body)
                        <section class="flex gap-5 py-8 sm:gap-8 sm:py-10">
                            <span aria-hidden="true" class="mt-1 font-display text-sm italic text-sea-600">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="min-w-0">
                                <h2 class="font-display text-2xl font-medium tracking-tight text-pine-950">{{ $heading }}</h2>
                                <p class="mt-4 text-base leading-relaxed text-pine-600">{{ $body }}</p>
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @php($relatedServices = array_intersect_key(\App\Support\Site::services(), array_flip($page['related_services'] ?? [])))
    @if ($relatedServices !== [])
        <nav aria-label="Related services" class="mx-auto max-w-6xl px-5 pb-16 sm:px-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sea-700">Related services</p>
            <ul class="mt-5 flex flex-wrap gap-x-8 gap-y-4">
                @foreach ($relatedServices as $name => $related)
                    <li><a href="{{ route($name) }}" class="font-display text-xl text-pine-900 underline underline-offset-4">{{ $related['card_title'] ?? $related['heading'] }}</a></li>
                @endforeach
            </ul>
        </nav>
    @endif
    @if (request()->routeIs('contact', 'patient-information')) @include('sections.location') @endif
    @if (request()->routeIs('contact')) @include('sections.contact') @endif
</x-layouts.app>
