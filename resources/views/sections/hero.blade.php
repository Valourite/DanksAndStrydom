{{-- ============================ HERO ============================ --}}
<section id="hero" class="relative isolate overflow-hidden pb-20 pt-32 sm:pt-40 lg:pb-28 lg:pt-48">

    {{-- Background washes --}}
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-bone-100 via-bone-50 to-bone-50"></div>
    <div data-parallax="0.16" class="pointer-events-none absolute -top-24 -right-40 -z-10 h-136 w-136 rounded-full bg-sea-100/70 blur-3xl will-change-transform"></div>
    <div data-parallax="0.09" class="pointer-events-none absolute -left-48 top-1/3 -z-10 h-96 w-96 rounded-full bg-sand-100/80 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-center gap-16 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-12">

        {{-- Copy --}}
        <div class="reveal max-w-xl">
            <p class="flex items-center gap-3 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-sea-600">
                <span class="h-px w-8 bg-sea-500/60"></span>
                Physiotherapy &middot; Rehabilitation &middot; Movement
            </p>

            <h1 class="mt-7 text-balance font-display text-[2.7rem] font-medium leading-[1.06] tracking-tight text-pine-950 sm:text-6xl lg:text-[4.1rem]">
                Personalised care for a body that
                <em class="text-sea-600">moves freely</em>
            </h1>

            <p class="mt-7 max-w-md text-pretty text-base leading-relaxed text-pine-600 sm:text-lg">
                Danks &amp; Strydom Physiotherapy provides hands-on treatment, rehabilitation, and movement-focused care to help you recover, strengthen, and return to everyday life with confidence.
            </p>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
                <a href="#contact"
                   class="inline-flex items-center justify-center gap-3 rounded-full bg-pine-900 py-3.5 pl-7 pr-3.5 text-sm font-semibold text-bone-50 shadow-[0_18px_40px_-18px_rgba(10,31,27,0.6)] transition-all duration-300 hover:bg-sea-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-600">
                    Book an appointment
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-bone-50/15">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                </a>
                <a href="#services"
                   class="group inline-flex items-center justify-center gap-2 px-2 py-3.5 text-sm font-semibold text-pine-900 transition-colors hover:text-sea-700">
                    View services
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-y-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
                </a>
            </div>

            {{-- Trust chips (mobile & tablet; desktop shows floating cards instead) --}}
            <ul class="mt-10 flex flex-wrap gap-2.5 lg:hidden">
                @foreach (['Sports injuries', 'Rehabilitation', 'Pain management', 'Personalised care'] as $chip)
                    <li class="rounded-full border border-pine-900/10 bg-white/70 px-4 py-2 text-xs font-medium text-pine-800 backdrop-blur">
                        {{ $chip }}
                    </li>
                @endforeach
            </ul>

            {{-- Stats --}}
            <dl class="mt-12 grid max-w-md grid-cols-3 divide-x divide-pine-900/10 border-t border-pine-900/10 pt-8">
                <div class="pr-5">
                    <dt class="font-display text-2xl font-medium text-pine-950 sm:text-3xl">15<span class="text-sea-600">+</span></dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-pine-500">Years combined experience</dd>
                </div>
                <div class="px-5">
                    <dt class="font-display text-2xl font-medium text-pine-950 sm:text-3xl">1<span class="text-sea-600">:</span>1</dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-pine-500">Personalised sessions</dd>
                </div>
                <div class="pl-5">
                    <dt class="font-display text-2xl font-medium text-pine-950 sm:text-3xl">8<span class="text-sea-600">+</span></dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-pine-500">Focused treatment areas</dd>
                </div>
            </dl>
        </div>

        {{-- Visual: arch composition --}}
        <div class="reveal relative mx-auto w-full max-w-sm lg:max-w-none" style="--reveal-delay: 150ms">

            {{-- Sand arch behind --}}
            <div data-parallax="0.07" class="absolute -right-6 top-10 hidden h-72 w-52 rounded-t-full bg-sand-200/80 sm:block lg:-right-10 lg:h-80 lg:w-60 will-change-transform" aria-hidden="true"></div>

            {{-- Main arch card --}}
            <div data-parallax="0.04" class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-linear-to-b from-pine-800 via-pine-900 to-pine-950 px-8 pb-10 pt-24 shadow-[0_40px_80px_-40px_rgba(10,31,27,0.7)] will-change-transform sm:px-10 sm:pt-28 lg:mr-8">
                {{-- inner glow --}}
                <div class="pointer-events-none absolute -top-20 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-sea-500/25 blur-3xl"></div>

                {{-- Flowing motion lines --}}
                <svg class="pointer-events-none absolute inset-x-0 top-12 mx-auto h-40 w-4/5 text-sea-400/30" viewBox="0 0 300 120" fill="none" aria-hidden="true">
                    <path d="M10 90 C 80 20, 150 140, 290 40" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10 105 C 90 40, 160 150, 290 60" stroke="currentColor" stroke-width="1" opacity="0.6"/>
                    <path d="M10 75 C 70 5, 140 120, 290 22" stroke="currentColor" stroke-width="0.8" opacity="0.4"/>
                </svg>

                <div class="relative">
                    <p class="font-display text-2xl font-medium leading-snug text-bone-50 sm:text-[1.7rem]">
                        Recovery,<br>
                        <em class="text-sea-300">guided by hand.</em>
                    </p>

                    <ul class="mt-8 space-y-3">
                        @foreach ([
                            ['Initial assessment', 'We listen and understand your goals'],
                            ['Hands-on treatment', 'Targeted, considered techniques'],
                            ['Guided rehabilitation', 'A plan built around your life'],
                        ] as $i => $step)
                            <li class="flex items-center gap-4 rounded-2xl border border-bone-50/10 bg-bone-50/5 px-4 py-3 backdrop-blur-sm">
                                <span class="font-display text-sm italic text-sea-300">0{{ $i + 1 }}</span>
                                <span class="min-w-0">
                                    <span class="block truncate text-sm font-medium text-bone-50">{{ $step[0] }}</span>
                                    <span class="block truncate text-xs text-pine-300">{{ $step[1] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Floating trust cards (desktop) --}}
            <div class="animate-drift absolute -left-14 top-44 hidden rounded-2xl border border-pine-900/8 bg-white/90 px-5 py-3.5 shadow-[0_20px_45px_-22px_rgba(10,31,27,0.4)] backdrop-blur lg:block">
                <p class="text-xs font-semibold text-pine-950">Sports injuries</p>
                <p class="mt-0.5 text-[0.68rem] text-pine-500">Back to play, safely</p>
            </div>
            <div class="animate-drift-slow absolute -bottom-6 left-8 hidden rounded-2xl border border-pine-900/8 bg-white/90 px-5 py-3.5 shadow-[0_20px_45px_-22px_rgba(10,31,27,0.4)] backdrop-blur lg:block">
                <p class="text-xs font-semibold text-pine-950">Pain management</p>
                <p class="mt-0.5 text-[0.68rem] text-pine-500">Move with more ease</p>
            </div>
            <div class="animate-drift absolute -right-2 top-32 hidden rounded-full border border-pine-900/8 bg-white/90 px-5 py-2.5 shadow-[0_20px_45px_-22px_rgba(10,31,27,0.4)] backdrop-blur lg:flex lg:items-center lg:gap-2" style="animation-delay: -4s">
                <span class="h-1.5 w-1.5 rounded-full bg-sea-500"></span>
                <span class="text-xs font-semibold text-pine-900">Personalised care</span>
            </div>
        </div>
    </div>
</section>
