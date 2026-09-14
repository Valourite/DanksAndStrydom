{{-- ============================ CONTACT ============================ --}}
<section id="contact" class="relative overflow-hidden py-24 sm:py-28 lg:py-36">
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-surface-50 to-surface-100"></div>
    <div data-parallax="0.12" class="pointer-events-none absolute -right-32 top-0 -z-10 h-md w-md rounded-full bg-accent-100/70 blur-3xl will-change-transform"></div>
    <div data-parallax="0.18" class="pointer-events-none absolute -left-24 bottom-0 -z-10 h-80 w-80 rounded-full bg-surface-100/80 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-start gap-14 px-5 sm:px-8 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">

        {{-- Intro --}}
        <div class="reveal lg:sticky lg:top-32">
            <x-site.section-heading eyebrow="Get in touch" align="left" title="Request an appointment or ask a question">
                Sending an enquiry does not confirm an appointment. Please wait for the practice to confirm the arrangements.
            </x-site.section-heading>

            <ul class="mt-10 space-y-0 divide-y divide-ink-900/8 border-y border-ink-900/8">
                @foreach ([
                        ['Appointment enquiries', 'Contact the practice to discuss your needs and availability.'],
                        ['Practice information', 'Ask reception about fees, referral requirements or medical aid.'],
                        ['Your privacy', 'Please avoid including detailed clinical information in your enquiry.'],
                    ] as $i => $item)
                        <li class="flex gap-5 py-5">
                            <span class="mt-0.5 font-display text-sm italic text-accent-600">0{{ $i + 1 }}</span>
                            <div>
                                <p class="text-sm font-semibold text-ink-900">{{ $item[0] }}</p>
                                <p class="mt-1 text-sm leading-relaxed text-ink-500">{{ $item[1] }}</p>
                            </div>
                        </li>
                @endforeach
            </ul>

            <div class="mt-8"><x-site.phone /></div>
        </div>

        {{-- Livewire form --}}
        <div class="reveal" style="--reveal-delay: 120ms">
            <livewire:contact-form />
        </div>
    </div>
</section>
