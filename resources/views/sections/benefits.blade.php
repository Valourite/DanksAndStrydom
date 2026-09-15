{{-- ============================ WHY CHOOSE US ============================ --}}
@php
    $benefits = [
        ['title' => 'Time for your first visit', 'body' => 'Appointments are one hour, with time to explain what has brought you in.'],
        ['title' => 'A little background', 'body' => 'New patients complete a patient-information form before the assessment.'],
        ['title' => 'Your priorities', 'body' => 'Tell your physiotherapist which movements or activities you want help with.'],
        ['title' => 'Assessment first', 'body' => 'Your physiotherapist assesses you before providing appropriate treatment.'],
        ['title' => 'Understanding the next step', 'body' => 'Ask questions about the findings and the care proposed for you.'],
        ['title' => 'Planning any follow-up', 'body' => 'Your physiotherapist will explain whether another appointment is needed and when to return.'],
    ];
@endphp

<section id="benefits" class="grain relative isolate overflow-hidden py-24 text-white sm:py-28 lg:py-36">
    {{-- Fixed parallax background --}}
    <div class="parallax-fixed absolute inset-0 -z-20 bg-linear-to-br from-ink-900 via-navy to-accent-900"></div>
    <div class="pointer-events-none absolute -left-24 top-16 -z-10 h-96 w-96 rounded-full bg-accent-600/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-20 bottom-0 -z-10 h-80 w-80 rounded-full bg-accent-500/10 blur-3xl"></div>

    <div class="mx-auto grid max-w-6xl gap-14 px-5 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-20">

        {{-- Sticky intro --}}
        <div class="reveal lg:sticky lg:top-32 lg:self-start">
            <p class="flex items-center gap-3 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-accent-300">
                <span class="h-px w-8 bg-accent-400/60"></span>
                Your visit
            </p>
            <h2 class="mt-6 font-display text-4xl font-medium leading-tight tracking-tight sm:text-5xl">Your appointment,<br><em class="text-accent-300">step by step.</em></h2>
            <p class="mt-6 max-w-sm text-base leading-relaxed text-ink-300">A first visit is a chance to understand the problem and begin care. Booking, payment and preparation details are collected on our patient-information page.</p>

            <figure class="mt-10 overflow-hidden rounded-3xl border border-surface-50/10 bg-surface-50/5 shadow-[0_30px_60px_-40px_rgba(var(--shadow-ink),0.8)]">
                <div class="relative aspect-4/3 overflow-hidden sm:aspect-16/10 lg:aspect-4/3">
                    <img
                        src="{{ asset('images/knee_strapping.webp') }}"
                        alt="A physiotherapist assessing kinesiology tape applied around a patient's knee"
                        width="1200"
                        height="900"
                        loading="lazy"
                        class="h-full w-full object-cover object-[center_48%]"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-navy/65 via-transparent to-transparent"></div>
                    <figcaption class="absolute inset-x-0 bottom-0 p-5 text-sm font-medium text-white">
                        Preparing for your appointment
                    </figcaption>
                </div>
            </figure>
        </div>

        {{-- Numbered editorial rows --}}
        <ol class="divide-y divide-surface-50/10 border-y border-surface-50/10">
            @foreach ($benefits as $i => $benefit)
                <li class="reveal group flex gap-6 py-7 transition-colors duration-300 sm:gap-10 sm:py-8" style="--reveal-delay: {{ $i * 70 }}ms">
                    <span class="mt-0.5 font-display text-sm italic text-accent-400/80 transition-colors duration-300 group-hover:text-accent-300 sm:text-base">
                        {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-display text-xl font-medium tracking-tight text-white transition-transform duration-300 group-hover:translate-x-1 sm:text-[1.35rem]">
                            {{ $benefit['title'] }}
                        </h3>
                        <p class="mt-2 max-w-md text-sm leading-relaxed text-ink-300">{{ $benefit['body'] }}</p>
                    </div>
                    <span class="mt-1 hidden h-8 w-8 shrink-0 items-center justify-center rounded-full border border-surface-50/15 text-white/40 transition-all duration-300 group-hover:border-accent-400 group-hover:text-accent-300 sm:flex">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</section>
