{{-- ============================ HERO ============================ --}}
<section id="hero" class="relative isolate overflow-hidden pb-20 pt-32 sm:pt-40 lg:pb-28 lg:pt-48">

    {{-- Background washes --}}
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-surface-100 via-surface-50 to-surface-50"></div>
    <div data-parallax="0.16" class="pointer-events-none absolute -top-24 -right-40 -z-10 h-136 w-136 rounded-full bg-accent-100/70 blur-3xl will-change-transform"></div>
    <div data-parallax="0.09" class="pointer-events-none absolute -left-48 top-1/3 -z-10 h-96 w-96 rounded-full bg-surface-100/80 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-center gap-16 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-12">

        {{-- Copy --}}
        <div class="reveal max-w-xl">
            <p class="flex items-center gap-3 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-accent-600">
                <span class="h-px w-8 bg-accent-500/60"></span>
                Physiotherapy &middot; Rehabilitation &middot; Movement
            </p>

            <h1 class="mt-7 text-balance font-display text-[2.7rem] font-medium leading-[1.06] tracking-tight text-ink-900 sm:text-6xl lg:text-[4.1rem]">
                Physiotherapy in Glen Marais,
                <em class="text-accent-600">Kempton Park</em>
            </h1>

            <p class="mt-7 max-w-md text-pretty text-base leading-relaxed text-ink-600 sm:text-lg">
                Pain, injury or restricted movement can interrupt everyday life. At Danks &amp; Strydom, physiotherapy starts with understanding what is difficult for you and what you want to get back to.
            </p>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
                <a href="#contact"
                   class="inline-flex items-center justify-center gap-3 rounded-full bg-brand py-3.5 pl-7 pr-3.5 text-sm font-semibold text-white shadow-[0_18px_40px_-18px_rgba(var(--shadow-ink),0.6)] transition-all duration-300 hover:bg-brand-hover focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent-600">
                    Request an appointment
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-surface-50/15">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                </a>
                <a href="#services"
                   class="group inline-flex items-center justify-center gap-2 px-2 py-3.5 text-sm font-semibold text-ink-900 transition-colors hover:text-accent-700">
                    View services
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-y-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
                </a>
            </div>

            {{-- Trust chips (mobile & tablet; desktop shows floating cards instead) --}}
            <ul class="mt-10 flex flex-wrap gap-2.5 lg:hidden">
                @foreach (['Back & neck pain', 'Sports rehabilitation', 'Post-operative rehabilitation'] as $chip)
                    <li class="rounded-full border border-ink-900/10 bg-card/70 px-4 py-2 text-xs font-medium text-ink-800 backdrop-blur">
                        {{ $chip }}
                    </li>
                @endforeach
            </ul>

            {{-- Stats --}}
            <dl class="mt-12 grid max-w-md grid-cols-3 divide-x divide-ink-900/10 border-t border-ink-900/10 pt-8">
                <div class="pr-5">
                    <dt class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">1<span class="text-accent-600"> hr</span></dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-ink-500">Appointment length</dd>
                </div>
                <div class="px-5">
                    <dt class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">2</dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-ink-500">Physiotherapists</dd>
                </div>
                <div class="pl-5">
                    <dt class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">{{ count(\App\Support\Site::services()) }}</dt>
                    <dd class="mt-1.5 text-[0.7rem] leading-snug text-ink-500">Physiotherapy services</dd>
                </div>
            </dl>
        </div>

        {{-- Visual: arch composition --}}
        <div class="reveal relative mx-auto w-full max-w-sm lg:max-w-none" style="--reveal-delay: 150ms">

            {{-- Sand arch behind --}}
            <div data-parallax="0.07" class="absolute -right-6 top-10 hidden h-72 w-52 rounded-t-full bg-surface-200/80 sm:block lg:-right-10 lg:h-80 lg:w-60 will-change-transform" aria-hidden="true"></div>

            {{-- Main arch card --}}
            <div data-parallax="0.04" class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-navy shadow-[0_40px_80px_-40px_rgba(var(--shadow-ink),0.7)] will-change-transform lg:mr-8">
                <div class="relative h-72 overflow-hidden sm:h-80 lg:h-88">
                    <img
                        src="{{ asset('images/back_strapping.webp') }}"
                        alt="Kinesiology tape being applied across a patient's shoulder and upper back"
                        width="1200"
                        height="900"
                        fetchpriority="high"
                        class="h-full w-full object-cover object-center"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-navy via-navy/15 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-5 flex justify-center">
                        <span class="rounded-full border border-surface-50/20 bg-navy/55 px-4 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.2em] text-white backdrop-blur-md">
                            Glen Marais, Kempton Park
                        </span>
                    </div>
                </div>

                <div class="relative px-8 pb-10 sm:px-10">
                    <p class="font-display text-2xl font-medium leading-snug text-white sm:text-[1.7rem]">
                        Movement,<br>
                        <em class="text-accent-300">with a purpose.</em>
                    </p>

                    <ul class="mt-8 space-y-3">
                        @foreach ([
                            ['Everyday comfort', 'Help with painful movements'],
                            ['Returning to activity', 'Support after injury or surgery'],
                            ['A clear starting point', 'Care shaped around you'],
                        ] as $i => $step)
                            <li class="flex items-center gap-4 rounded-2xl border border-surface-50/10 bg-surface-50/5 px-4 py-3 backdrop-blur-sm">
                                <span class="font-display text-sm italic text-accent-300">0{{ $i + 1 }}</span>
                                <span class="min-w-0">
                                    <span class="block truncate text-sm font-medium text-white">{{ $step[0] }}</span>
                                    <span class="block truncate text-xs text-ink-300">{{ $step[1] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Floating trust cards (desktop) --}}
            <div class="animate-drift absolute -left-14 top-44 hidden rounded-2xl border border-ink-900/8 bg-card/90 px-5 py-3.5 shadow-[0_20px_45px_-22px_rgba(var(--shadow-ink),0.4)] backdrop-blur lg:block">
                <p class="text-xs font-semibold text-ink-900">Sports injuries</p>
                <p class="mt-0.5 text-[0.68rem] text-ink-500">Returning to activity</p>
            </div>
            <div class="animate-drift-slow absolute -bottom-6 left-8 hidden rounded-2xl border border-ink-900/8 bg-card/90 px-5 py-3.5 shadow-[0_20px_45px_-22px_rgba(var(--shadow-ink),0.4)] backdrop-blur lg:block">
                <p class="text-xs font-semibold text-ink-900">Back &amp; neck pain</p>
                <p class="mt-0.5 text-[0.68rem] text-ink-500">Everyday movement</p>
            </div>
            <div class="animate-drift absolute -right-2 top-32 hidden rounded-full border border-ink-900/8 bg-card/90 px-5 py-2.5 shadow-[0_20px_45px_-22px_rgba(var(--shadow-ink),0.4)] backdrop-blur lg:flex lg:items-center lg:gap-2" style="animation-delay: -4s">
                <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                <span class="text-xs font-semibold text-ink-900">Glen Marais</span>
            </div>
        </div>
    </div>
</section>
