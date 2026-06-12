@php
    $practice = config('contact.practice');
@endphp

<footer class="grain relative overflow-hidden bg-pine-950 text-pine-200">
    <div class="pointer-events-none absolute -top-40 left-1/2 h-80 w-2xl -translate-x-1/2 rounded-full bg-sea-700/15 blur-3xl"></div>

    <div class="relative mx-auto max-w-6xl px-5 pb-10 pt-20 sm:px-8 lg:pt-24">

        {{-- Top row: big invitation --}}
        <div class="flex flex-col gap-10 border-b border-bone-50/10 pb-14 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-xl">
                <p class="text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-sea-400">Danks &amp; Strydom Physiotherapy</p>
                <p class="mt-4 font-display text-3xl font-medium leading-snug tracking-tight text-bone-50 sm:text-4xl">
                    Ready when you are —
                    <em class="text-sea-300">let’s get you moving.</em>
                </p>
            </div>
            <a href="#contact"
               class="inline-flex w-fit items-center gap-3 rounded-full border border-bone-50/20 py-3 pl-6 pr-3 text-sm font-semibold text-bone-50 transition-all duration-300 hover:border-sea-400 hover:text-sea-300">
                Book an appointment
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-sea-500 text-pine-950">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </span>
            </a>
        </div>

        {{-- Middle: columns --}}
        <div class="grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <h3 class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-pine-400">Visit</h3>
                <p class="mt-4 text-sm leading-relaxed text-pine-200">{{ $practice['address'] }}</p>
            </div>
            <div>
                <h3 class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-pine-400">Contact</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $practice['phone']) }}" class="transition-colors hover:text-sea-300">{{ $practice['phone'] }}</a></li>
                    <li><a href="mailto:{{ $practice['email'] }}" class="transition-colors hover:text-sea-300">{{ $practice['email'] }}</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-pine-400">Hours</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    @foreach ($practice['hours'] as $day => $time)
                        <li class="flex justify-between gap-4 sm:max-w-56">
                            <span class="text-pine-300">{{ $day }}</span>
                            <span class="text-pine-100">{{ $time }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-pine-400">Explore</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    @foreach ([
                        'Services' => '#services',
                        'About' => '#about',
                        'Why choose us' => '#benefits',
                        'Testimonials' => '#testimonials',
                        'Contact' => '#contact',
                    ] as $label => $href)
                        <li><a href="{{ $href }}" class="transition-colors hover:text-sea-300">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Giant wordmark --}}
        <p aria-hidden="true" class="select-none border-t border-bone-50/10 pt-10 text-center font-display text-[11.5vw] font-medium leading-none tracking-tight text-bone-50/6 lg:text-[7.5rem]">
            Danks &amp; Strydom
        </p>

        {{-- Bottom row --}}
        <div class="mt-8 flex flex-col items-center justify-between gap-3 text-xs text-pine-400 sm:flex-row">
            <p>&copy; {{ now()->year }} {{ $practice['name'] }}. All rights reserved.</p>
            <p>General information only — not medical advice.</p>
        </div>
    </div>
</footer>
