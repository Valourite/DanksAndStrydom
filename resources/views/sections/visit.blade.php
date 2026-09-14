<section id="visit" class="relative overflow-hidden py-24 sm:py-28 lg:py-36">
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-bone-50 via-bone-100 to-bone-50"></div>
    <div data-parallax="0.08" class="pointer-events-none absolute -left-32 top-24 -z-10 h-96 w-96 rounded-full bg-sea-100/60 blur-3xl will-change-transform"></div>
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Plan your visit" title="A little information before you arrive">Find the practice, check our hours and get in touch.</x-site.section-heading>
        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="flex flex-col gap-5">
                <x-site.visit-card eyebrow="Find us" title="Surgiklin Studios">{{ config('contact.practice.address') }}</x-site.visit-card>
                <x-site.visit-card eyebrow="Arrival" title="At the entrance">{{ config('contact.practice.arrival') }}</x-site.visit-card>
            </div>
            <div class="flex flex-col gap-5 lg:pt-10">
                <x-site.visit-card eyebrow="Opening hours" title="When to visit">{{ config('contact.practice.hours') }}</x-site.visit-card>
                <x-site.visit-card eyebrow="Access" title="Parking and the building">{{ config('contact.practice.access') }}</x-site.visit-card>
            </div>
            <div class="flex flex-col gap-5 sm:col-span-2 sm:flex-row lg:col-span-1 lg:flex-col lg:pt-20">
                <x-site.visit-card class="flex-1" eyebrow="Your enquiry" title="Speak to the practice">Contact us to discuss your needs and request an appointment. An enquiry does not confirm a booking.</x-site.visit-card>
                <div class="reveal grain relative flex flex-col overflow-hidden rounded-3xl bg-pine-950 text-bone-50 sm:flex-1 lg:flex-none">
                    <div class="relative h-44 overflow-hidden sm:h-48 lg:h-40">
                        <img src="{{ asset('images/valf_physio.webp') }}" alt="Physiotherapy illustration: treatment of the lower leg" width="1200" height="900" loading="lazy" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-linear-to-t from-pine-950 via-pine-950/15 to-transparent"></div>
                    </div>
                    <div class="relative -mt-4 p-8 pt-6">
                        <p class="font-display text-[1.45rem] font-medium leading-snug">Your next step,<br><em class="text-sea-300">a conversation.</em></p>
                        <a href="{{ route('contact') }}#contact" class="mt-6 inline-flex text-sm font-semibold text-sea-300 underline underline-offset-4">Request an appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
