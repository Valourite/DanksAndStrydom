{{-- ============================ TESTIMONIALS ============================ --}}
@php
    $testimonials = [
        ['name' => 'Sarah M.', 'detail' => 'Back pain recovery', 'quote' => 'After months of lower back pain, I finally feel like myself again. They took real time to understand my situation, and the exercises actually made a difference.'],
        ['name' => 'James T.', 'detail' => 'Sports injury', 'quote' => 'Recovering from a knee injury felt daunting, but the personalised plan got me back on the field gradually and safely. Professional and genuinely encouraging.'],
        ['name' => 'Priya N.', 'detail' => 'Post-operative rehab', 'quote' => 'The guidance after my surgery was clear and reassuring at every step. I always knew what to do next and felt fully supported throughout.'],
        ['name' => 'David R.', 'detail' => 'Improved mobility', 'quote' => 'I came in stiff and uncertain about moving freely again. The exercises were easy to follow and my mobility has improved more than I expected.'],
        ['name' => 'Lerato K.', 'detail' => 'Chronic pain support', 'quote' => 'What stood out was how much they listened. The calm, friendly approach made a real difference — I finally have practical tools to manage my pain.'],
    ];
@endphp

<section id="testimonials" class="relative overflow-hidden py-24 sm:py-28 lg:py-36">
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-bone-50 via-bone-100 to-bone-50"></div>
    <div data-parallax="0.08"
        class="pointer-events-none absolute -left-32 top-24 -z-10 h-96 w-96 rounded-full bg-sea-100/60 blur-3xl will-change-transform">
    </div>

    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Patient stories" title="Trusted by people getting back to what they love">
            Real experiences from people we’ve supported on their recovery journey.
        </x-site.section-heading>

        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Column 1 --}}
            <div class="flex flex-col gap-5">
                <x-site.testimonial-card :name="$testimonials[0]['name']" :detail="$testimonials[0]['detail']">
                    {{ $testimonials[0]['quote'] }}
                </x-site.testimonial-card>
                <x-site.testimonial-card :name="$testimonials[1]['name']" :detail="$testimonials[1]['detail']"
                    style="--reveal-delay: 90ms">
                    {{ $testimonials[1]['quote'] }}
                </x-site.testimonial-card>
            </div>

            {{-- Column 2: offset on desktop --}}
            <div class="flex flex-col gap-5 lg:pt-10">
                <x-site.testimonial-card :name="$testimonials[2]['name']" :detail="$testimonials[2]['detail']"
                    style="--reveal-delay: 140ms">
                    {{ $testimonials[2]['quote'] }}
                </x-site.testimonial-card>
                <x-site.testimonial-card :name="$testimonials[3]['name']" :detail="$testimonials[3]['detail']"
                    style="--reveal-delay: 200ms">
                    {{ $testimonials[3]['quote'] }}
                </x-site.testimonial-card>
            </div>

            {{-- Column 3 --}}
            <div class="flex flex-col gap-5 sm:col-span-2 sm:flex-row lg:col-span-1 lg:flex-col lg:pt-20">
                <x-site.testimonial-card class="sm:flex-1 lg:flex-none" :name="$testimonials[4]['name']"
                    :detail="$testimonials[4]['detail']" style="--reveal-delay: 240ms">
                    {{ $testimonials[4]['quote'] }}
                </x-site.testimonial-card>

                {{-- Closing CTA tile --}}
                <div class="reveal grain relative flex flex-col justify-center overflow-hidden rounded-3xl bg-pine-950 p-8 text-bone-50 sm:flex-1 lg:flex-none"
                    style="--reveal-delay: 300ms">
                    <div
                        class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full bg-sea-500/25 blur-2xl">
                    </div>
                    <p class="relative font-display text-[1.45rem] font-medium leading-snug">
                        Your story could be <em class="text-sea-300">next.</em>
                    </p>
                    <p class="relative mt-3 text-sm leading-relaxed text-pine-300">
                        Patients consistently tell us they feel heard, supported, and confident in their recovery.
                    </p>
                    <a href="#contact"
                        class="group relative mt-6 inline-flex w-fit items-center gap-2 text-sm font-semibold text-sea-300 transition-colors hover:text-bone-50">
                        Book an appointment
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>