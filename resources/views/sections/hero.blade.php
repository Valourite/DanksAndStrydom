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
                Physiotherapy in Glen Marais,
                <em class="text-sea-600">Kempton Park</em>
            </h1>

            <p class="mt-7 max-w-md text-pretty text-base leading-relaxed text-pine-600 sm:text-lg">
                Contact Danks &amp; Strydom to discuss your physiotherapy needs and request an appointment.
            </p>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
                <a href="#contact"
                   class="inline-flex items-center justify-center gap-3 rounded-full bg-pine-900 py-3.5 pl-7 pr-3.5 text-sm font-semibold text-bone-50 shadow-[0_18px_40px_-18px_rgba(10,31,27,0.6)] transition-all duration-300 hover:bg-sea-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-600">
                    Request an appointment
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
            <x-site.phone />
        </div>

        {{-- Visual: arch composition --}}
        <div class="reveal relative mx-auto w-full max-w-sm lg:max-w-none" style="--reveal-delay: 150ms">

            {{-- Sand arch behind --}}
            <div data-parallax="0.07" class="absolute -right-6 top-10 hidden h-72 w-52 rounded-t-full bg-sand-200/80 sm:block lg:-right-10 lg:h-80 lg:w-60 will-change-transform" aria-hidden="true"></div>

            {{-- Main arch card --}}
            <div data-parallax="0.04" class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-pine-950 shadow-[0_40px_80px_-40px_rgba(10,31,27,0.7)] will-change-transform lg:mr-8">
                <div class="relative h-72 overflow-hidden sm:h-80 lg:h-88">
                    <img
                        src="{{ asset('images/back_strapping.webp') }}"
                        alt="Kinesiology tape being applied across a patient's shoulder and upper back"
                        width="1200"
                        height="900"
                        fetchpriority="high"
                        class="h-full w-full object-cover object-center"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-pine-950 via-pine-950/15 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-5 flex justify-center">
                        <span class="rounded-full border border-bone-50/20 bg-pine-950/55 px-4 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.2em] text-bone-50 backdrop-blur-md">
                            Focused, hands-on care
                        </span>
                    </div>
                </div>

                <div class="relative px-8 pb-10 sm:px-10">
                    <p class="font-display text-2xl font-medium leading-snug text-bone-50 sm:text-[1.7rem]">
                        Recovery,<br>
                        <em class="text-sea-300">guided by hand.</em>
                    </p>


                </div>
            </div>

        </div>
    </div>
</section>
