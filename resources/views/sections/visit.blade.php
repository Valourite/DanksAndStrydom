<section id="visit" class="relative overflow-hidden py-24 sm:py-28 lg:py-36">
    <div class="absolute inset-0 -z-20 bg-linear-to-b from-surface-50 via-surface-100 to-surface-50"></div>
    <div data-parallax="0.08" class="pointer-events-none absolute -left-32 top-24 -z-10 h-96 w-96 rounded-full bg-accent-100/60 blur-3xl will-change-transform"></div>
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Your questions" title="A clearer way to get started">You do not need to know which treatment to ask for before making an appointment.</x-site.section-heading>
        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="flex flex-col gap-5">
                <x-site.visit-card eyebrow="Getting started" title="Not sure which service?">Start with the difficulty you want help with. An assessment can establish which care is relevant to you.</x-site.visit-card>
                <x-site.visit-card eyebrow="Everyday goals" title="What matters to you">Think about a task, movement or activity you would like to manage more easily.</x-site.visit-card>
            </div>
            <div class="flex flex-col gap-5 lg:pt-10">
                <x-site.visit-card eyebrow="Your care" title="Room for questions">Use your appointment to ask about the findings and understand the next steps in your care.</x-site.visit-card>
                <x-site.visit-card eyebrow="Between visits" title="If something changes">Call or message the practice if you need advice about whether to return sooner.</x-site.visit-card>
            </div>
            <div class="flex flex-col gap-5 sm:col-span-2 sm:flex-row lg:col-span-1 lg:flex-col lg:pt-20">
                <x-site.visit-card class="flex-1" eyebrow="Practical details" title="Before you arrive">Find appointment preparation, fees, medical aid and cancellation information in one place.</x-site.visit-card>
                <div class="reveal grain relative flex flex-col overflow-hidden rounded-3xl bg-navy text-white sm:flex-1 lg:flex-none">
                    <div class="relative h-44 overflow-hidden sm:h-48 lg:h-40">
                        <img src="{{ asset('images/valf_physio.webp') }}" alt="Physiotherapy illustration: treatment of the lower leg" width="1200" height="900" loading="lazy" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-linear-to-t from-navy via-navy/15 to-transparent"></div>
                    </div>
                    <div class="relative -mt-4 p-8 pt-6">
                        <p class="font-display text-[1.45rem] font-medium leading-snug">Your first visit,<br><em class="text-accent-300">made clearer.</em></p>
                        <a href="{{ route('patient-information') }}" class="mt-6 inline-flex text-sm font-semibold text-accent-300 underline underline-offset-4">Read patient information</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
