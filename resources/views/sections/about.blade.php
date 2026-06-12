{{-- ============================ ABOUT ============================ --}}
<section id="about" class="relative overflow-hidden  sm:py-28 lg:pb-36">
    <div data-parallax="0.1" class="pointer-events-none absolute -right-40 top-16 -z-10 h-112 w-md rounded-full bg-sea-100/60 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-center gap-16 px-5 sm:px-8 lg:grid-cols-[0.92fr_1.08fr] lg:gap-20">

        {{-- Visual --}}
        <div class="reveal relative order-last mx-auto w-full max-w-md lg:order-first lg:max-w-none">
            {{-- Arch panel --}}
            <div class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-linear-to-b from-sea-700 via-pine-800 to-pine-950 px-8 pb-9 pt-28 sm:px-9">
                <div class="pointer-events-none absolute -top-16 left-1/2 h-56 w-56 -translate-x-1/2 rounded-full bg-sea-400/25 blur-3xl"></div>

                <p class="relative text-center font-display text-[1.6rem] font-medium leading-snug text-bone-50">
                    “We treat the <em class="text-sea-300">person</em>,<br>not just the problem.”
                </p>

                <div class="relative mt-9 grid grid-cols-2 gap-3">
                    <div class="rounded-2xl border border-bone-50/10 bg-bone-50/5 p-4 text-center backdrop-blur-sm">
                        <p class="font-display text-2xl font-medium text-bone-50">1:1</p>
                        <p class="mt-1 text-[0.68rem] leading-snug text-pine-300">Unhurried, focused sessions</p>
                    </div>
                    <div class="rounded-2xl border border-bone-50/10 bg-bone-50/5 p-4 text-center backdrop-blur-sm">
                        <p class="font-display text-2xl font-medium text-bone-50">100%</p>
                        <p class="mt-1 text-[0.68rem] leading-snug text-pine-300">Evidence-informed care</p>
                    </div>
                </div>
            </div>

            {{-- Offset sand card --}}
            <div class="animate-drift-slow absolute -right-5 -top-4 hidden rounded-2xl bg-sand-200 px-5 py-4 shadow-[0_20px_45px_-22px_rgba(10,31,27,0.35)] sm:block">
                <p class="font-display text-lg font-medium text-pine-950">Welcoming &amp; calm</p>
                <p class="mt-0.5 text-[0.7rem] text-pine-700">From your very first visit</p>
            </div>
        </div>

        {{-- Copy --}}
        <div class="reveal">
            <x-site.section-heading eyebrow="About the practice" align="left" title="Care that listens first, then guides you forward" />

            <div class="mt-7 space-y-5 text-base leading-relaxed text-pine-600">
                <p class="border-l-2 border-sea-500/50 pl-5 font-display text-lg italic leading-relaxed text-pine-800">
                    Great care starts with truly understanding you — your story, your body, and where you want to be.
                </p>
                <p>
                    At Danks &amp; Strydom Physiotherapy, every treatment plan is personalised. We take time to listen and assess carefully, then combine hands-on, evidence-informed techniques with clear, practical guidance you can use between sessions.
                </p>
                <p>
                    Our focus is long-term: helping you recover mobility and strength, and supporting lasting wellbeing — not just easing today’s symptoms. And we do it all in a calm, supportive environment where you’ll feel comfortable from the moment you arrive.
                </p>
            </div>

            <ul class="mt-9 grid gap-x-8 gap-y-3.5 sm:grid-cols-2">
                @foreach ([
                        'Personalised treatment plans',
                        'Evidence-informed techniques',
                        'A calm, supportive environment',
                        'Focused on long-term recovery',
                    ] as $point)
                        <li class="flex items-center gap-3 text-sm font-medium text-pine-800">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-sea-100 text-sea-700">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                            </span>
                            {{ $point }}
                        </li>
                @endforeach
            </ul>

            <a href="#contact" class="group mt-10 inline-flex items-center gap-3 rounded-full border border-pine-900/15 py-3 pl-6 pr-3 text-sm font-semibold text-pine-900 transition-all duration-300 hover:border-pine-900 hover:bg-pine-900 hover:text-bone-50">
                Start your recovery journey
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-pine-900 text-bone-50 transition-colors duration-300 group-hover:bg-sea-500">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>
