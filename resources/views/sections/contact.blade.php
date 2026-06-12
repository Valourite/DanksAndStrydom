{{-- ============================ CONTACT ============================ --}}
<section id="contact" class="relative overflow-hidden py-24 sm:py-28 lg:py-36">
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-bone-50 to-bone-100"></div>
    <div data-parallax="0.12" class="pointer-events-none absolute -right-32 top-0 -z-10 h-md w-md rounded-full bg-sea-100/70 blur-3xl will-change-transform"></div>
    <div data-parallax="0.18" class="pointer-events-none absolute -left-24 bottom-0 -z-10 h-80 w-80 rounded-full bg-sand-100/80 blur-3xl will-change-transform"></div>

    <div class="mx-auto grid max-w-6xl items-start gap-14 px-5 sm:px-8 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">

        {{-- Intro --}}
        <div class="reveal lg:sticky lg:top-32">
            <x-site.section-heading eyebrow="Get in touch" align="left" title="Book an appointment or ask a question">
                Tell us a little about what you need and we'll get back to you — usually within one business day.
            </x-site.section-heading>

            <ul class="mt-10 space-y-0 divide-y divide-pine-900/8 border-y border-pine-900/8">
                @foreach ([
                        ['No referral needed', 'You can book directly with us — no doctor\'s referral required.'],
                        ['Friendly, no-pressure advice', 'Unsure if physiotherapy is right for you? Just ask.'],
                        ['Care designed around your goals', 'Every plan starts with a conversation about you.'],
                    ] as $i => $item)
                        <li class="flex gap-5 py-5">
                            <span class="mt-0.5 font-display text-sm italic text-sea-600">0{{ $i + 1 }}</span>
                            <div>
                                <p class="text-sm font-semibold text-pine-950">{{ $item[0] }}</p>
                                <p class="mt-1 text-sm leading-relaxed text-pine-500">{{ $item[1] }}</p>
                            </div>
                        </li>
                @endforeach
            </ul>

            <p class="mt-8 text-sm text-pine-500">
                Prefer to call?
                <a href="tel:{{ preg_replace('/\s+/', '', config('contact.practice.phone')) }}" class="font-semibold text-sea-700 underline-offset-4 hover:underline">{{ config('contact.practice.phone') }}</a>
                during business hours.
            </p>
        </div>

        {{-- Livewire form --}}
        <div class="reveal" style="--reveal-delay: 120ms">
            <livewire:contact-form />
        </div>
    </div>
</section>
