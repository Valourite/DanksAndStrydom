{{-- ============================ WHY CHOOSE US ============================ --}}
@php
    $benefits = [
        ['title' => 'Personalised to you',  'body' => 'No two bodies are the same. Your plan is shaped around your goals, lifestyle, and stage of recovery.'],
        ['title' => 'Hands-on expertise',   'body' => 'Skilled manual therapy combined with movement-focused care, so you progress with confidence.'],
        ['title' => 'Evidence-informed',    'body' => 'Treatment grounded in current best practice — care you can genuinely trust.'],
        ['title' => 'Clear guidance',       'body' => 'Simple, practical exercises and advice you can follow at home, with support along the way.'],
        ['title' => 'A calm environment',   'body' => 'A welcoming, unhurried space where you feel comfortable and genuinely cared for.'],
        ['title' => 'Long-term results',    'body' => 'We focus on lasting improvement and prevention — not just easing today\'s symptoms.'],
    ];
@endphp

<section id="benefits" class="grain relative isolate overflow-hidden py-24 text-bone-50 sm:py-28 lg:py-36">
    {{-- Fixed parallax background --}}
    <div class="parallax-fixed absolute inset-0 -z-20 bg-linear-to-br from-pine-900 via-pine-950 to-sea-900"></div>
    <div class="pointer-events-none absolute -left-24 top-16 -z-10 h-96 w-96 rounded-full bg-sea-600/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-20 bottom-0 -z-10 h-80 w-80 rounded-full bg-sand-400/10 blur-3xl"></div>

    <div class="mx-auto grid max-w-6xl gap-14 px-5 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-20">

        {{-- Sticky intro --}}
        <div class="reveal lg:sticky lg:top-32 lg:self-start">
            <p class="flex items-center gap-3 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-sea-300">
                <span class="h-px w-8 bg-sea-400/60"></span>
                Why choose us
            </p>
            <h2 class="mt-6 text-balance font-display text-[2.1rem] font-medium leading-[1.12] tracking-tight text-bone-50 sm:text-[2.6rem] lg:text-5xl lg:leading-[1.08]">
                Thoughtful care that puts your
                <em class="text-sea-300">recovery first</em>
            </h2>
            <p class="mt-6 max-w-md text-pretty text-base leading-relaxed text-pine-200 sm:text-lg">
                Everything we do is designed to help you move, recover, and feel better — supported by a team that genuinely cares.
            </p>
            <a href="#contact"
               class="mt-9 inline-flex items-center gap-3 rounded-full bg-bone-50 py-3 pl-6 pr-3 text-sm font-semibold text-pine-950 transition-all duration-300 hover:bg-sea-300">
                Book your first session
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-pine-950 text-bone-50">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </span>
            </a>

            <figure class="mt-10 overflow-hidden rounded-3xl border border-bone-50/10 bg-bone-50/5 shadow-[0_30px_60px_-40px_rgba(0,0,0,0.8)]">
                <div class="relative aspect-4/3 overflow-hidden sm:aspect-16/10 lg:aspect-4/3">
                    <img
                        src="{{ asset('images/knee_strapping.webp') }}"
                        alt="A physiotherapist assessing kinesiology tape applied around a patient's knee"
                        width="1200"
                        height="900"
                        loading="lazy"
                        class="h-full w-full object-cover object-[center_48%]"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-pine-950/65 via-transparent to-transparent"></div>
                    <figcaption class="absolute inset-x-0 bottom-0 p-5 text-sm font-medium text-bone-50">
                        Practical support for confident movement
                    </figcaption>
                </div>
            </figure>
        </div>

        {{-- Numbered editorial rows --}}
        <ol class="divide-y divide-bone-50/10 border-y border-bone-50/10">
            @foreach ($benefits as $i => $benefit)
                <li class="reveal group flex gap-6 py-7 transition-colors duration-300 sm:gap-10 sm:py-8" style="--reveal-delay: {{ $i * 70 }}ms">
                    <span class="mt-0.5 font-display text-sm italic text-sea-400/80 transition-colors duration-300 group-hover:text-sea-300 sm:text-base">
                        {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-display text-xl font-medium tracking-tight text-bone-50 transition-transform duration-300 group-hover:translate-x-1 sm:text-[1.35rem]">
                            {{ $benefit['title'] }}
                        </h3>
                        <p class="mt-2 max-w-md text-sm leading-relaxed text-pine-300">{{ $benefit['body'] }}</p>
                    </div>
                    <span class="mt-1 hidden h-8 w-8 shrink-0 items-center justify-center rounded-full border border-bone-50/15 text-bone-50/40 transition-all duration-300 group-hover:border-sea-400 group-hover:text-sea-300 sm:flex">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</section>
