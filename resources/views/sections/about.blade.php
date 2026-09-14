{{-- ============================ ABOUT ============================ --}}
<section id="about" class="relative overflow-hidden py-24 sm:py-28 lg:pb-36">
    <div data-parallax="0.1" class="pointer-events-none absolute -right-40 top-16 -z-10 h-112 w-md rounded-full bg-sea-100/60 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-center gap-16 px-5 sm:px-8 lg:grid-cols-[0.92fr_1.08fr] lg:gap-20">

        {{-- Visual --}}
        <div class="reveal relative order-last mx-auto w-full max-w-md lg:order-first lg:max-w-none">
            {{-- Arch panel --}}
            <div class="grain relative overflow-hidden rounded-t-full rounded-b-[2.5rem] bg-pine-950 shadow-[0_35px_70px_-42px_rgba(10,31,27,0.65)]">
                <div class="relative h-72 overflow-hidden sm:h-80">
                    <img
                        src="{{ asset('images/valf_physio.webp') }}"
                        alt="A physiotherapist providing focused hands-on treatment"
                        width="1200"
                        height="900"
                        loading="lazy"
                        class="h-full w-full object-cover object-center"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-pine-950 via-pine-950/5 to-transparent"></div>
                </div>

                <div class="relative -mt-7 px-8 pb-9 sm:px-9">
                    <p class="text-center font-display text-[1.6rem] font-medium leading-snug text-bone-50">
                        Physiotherapy in<br><em class="text-sea-300">Glen Marais.</em>
                    </p>

                    <div class="mt-8 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-bone-50/10 bg-bone-50/5 p-4 text-center backdrop-blur-sm">
                            <p class="font-display text-2xl font-medium text-bone-50">1 hour</p>
                            <p class="mt-1 text-[0.68rem] leading-snug text-pine-300">Appointment length</p>
                        </div>
                        <div class="rounded-2xl border border-bone-50/10 bg-bone-50/5 p-4 text-center backdrop-blur-sm">
                            <p class="font-display text-2xl font-medium text-bone-50">2</p>
                            <p class="mt-1 text-[0.68rem] leading-snug text-pine-300">Physiotherapists</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Offset sand card --}}
            <div class="animate-drift-slow absolute -right-5 -top-4 hidden rounded-2xl bg-sand-200 px-5 py-4 shadow-[0_20px_45px_-22px_rgba(10,31,27,0.35)] sm:block">
                <p class="font-display text-lg font-medium text-pine-950">Surgiklin Studios</p>
                <p class="mt-0.5 text-[0.7rem] text-pine-700">Suite 102 · Glen Eagle Office Park</p>
            </div>
        </div>

        {{-- Copy --}}
        <div class="reveal">
            <x-site.section-heading eyebrow="About the practice" align="left" title="Meet your local physiotherapy practice" />

            <div class="mt-7 space-y-5 text-base leading-relaxed text-pine-600">
                <p class="border-l-2 border-sea-500/50 pl-5 font-display text-lg italic leading-relaxed text-pine-800">Elize Strydom and Cheryl Myburgh both hold degrees in physiotherapy.</p>
                <p>Both physiotherapists provide back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation.</p>
                <p>Find Danks &amp; Strydom at Surgiklin Studios in Glen Eagle Office Park, Glen Marais, Kempton Park. Contact the practice to discuss your needs and arrange an assessment.</p>
            </div>

            <ul class="mt-9 grid gap-x-8 gap-y-3.5 sm:grid-cols-2">
                @foreach ([
                        'One-hour appointments',
                        'Assessment before treatment',
                        'Nothing to bring',
                        'Glen Marais, Kempton Park',
                    ] as $point)
                        <li class="flex items-center gap-3 text-sm font-medium text-pine-800">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-sea-100 text-sea-700">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                            </span>
                            {{ $point }}
                        </li>
                @endforeach
            </ul>

            <a href="{{ isset(\App\Support\Site::pages()['about']) ? route('about') : route('contact').'#contact' }}" class="group mt-10 inline-flex items-center gap-3 rounded-full border border-pine-900/15 py-3 pl-6 pr-3 text-sm font-semibold text-pine-900 transition-all duration-300 hover:border-pine-900 hover:bg-pine-900 hover:text-bone-50">
                {{ isset(\App\Support\Site::pages()['about']) ? 'Meet the physiotherapists' : 'Contact the practice' }}
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-pine-900 text-bone-50 transition-colors duration-300 group-hover:bg-sea-500">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>
