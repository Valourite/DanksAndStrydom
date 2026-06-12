{{-- ============================ SERVICES ============================ --}}
@php
    $services = [
        ['icon' => 'pulse',    'title' => 'Sports Injury Rehabilitation',      'body' => 'Goal-focused recovery designed around your sport and stage of healing, to help you return to training with confidence.'],
        ['icon' => 'spine',    'title' => 'Back & Neck Pain Treatment',        'body' => 'Hands-on techniques and targeted exercises to help ease discomfort and support better movement through your day.'],
        ['icon' => 'recovery', 'title' => 'Post-Operative Rehabilitation',     'body' => 'Structured, progressive programmes aligned with your surgical guidelines to help rebuild strength and mobility.'],
        ['icon' => 'joint',    'title' => 'Joint & Muscle Pain',               'body' => 'Careful assessment and treatment for everyday aches, strains, and stiffness — focused on comfortable movement.'],
        ['icon' => 'mobility', 'title' => 'Mobility & Movement Assessment',    'body' => 'A thorough look at how you move, identifying limitations and shaping a clear, personalised plan forward.'],
        ['icon' => 'chronic',  'title' => 'Chronic Pain Management',           'body' => 'Supportive, evidence-informed strategies to help you manage persistent pain and stay active in daily life.'],
        ['icon' => 'shield',   'title' => 'Injury Prevention',                 'body' => 'Practical guidance and conditioning to help reduce injury risk and keep you doing what you love.'],
        ['icon' => 'program',  'title' => 'Rehabilitation Exercise Programmes', 'body' => 'Clear, achievable home exercise plans designed around your goals, with guidance at every step.'],
    ];

    $galleryImages = [
        ['src' => 'images/cheryl-horse-1.webp', 'alt' => 'Cheryl working with a horse'],
        ['src' => 'images/cheryl-horse-2.webp', 'alt' => 'Cheryl providing equestrian physiotherapy'],
        ['src' => 'images/elize-horse-1.webp', 'alt' => 'Elize working with a horse'],
        ['src' => 'images/elize-messsage-1.webp', 'alt' => 'Elize providing massage treatment'],
        ['src' => 'images/elize-physio-1.webp', 'alt' => 'Elize during a physiotherapy session'],
        ['src' => 'images/elize-physio-2.webp', 'alt' => 'Elize providing physiotherapy treatment'],
        ['src' => 'images/physios-massage-1.webp', 'alt' => 'Physiotherapists demonstrating massage treatment'],
    ];
@endphp

<section id="services" class="relative py-24 sm:py-28 lg:pt-36">
    <div class="absolute inset-0 -z-10 bg-linear-to-b from-bone-50 via-white to-bone-50"></div>

    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <x-site.section-heading eyebrow="What we do" align="left" title="Care designed around your goals">
                From sports injuries to everyday aches — hands-on, personalised treatment focused on helping you move and feel better.
            </x-site.section-heading>
            <a href="#contact" class="reveal group inline-flex w-fit shrink-0 items-center gap-2 text-sm font-semibold text-pine-900 transition-colors hover:text-sea-700">
                Not sure where to start? Ask us
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>

        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($services as $i => $service)
                <x-site.service-card
                    :icon="$service['icon']"
                    :title="$service['title']"
                    :index="$i + 1"
                    style="--reveal-delay: {{ ($i % 4) * 90 }}ms">
                    {{ $service['body'] }}
                </x-site.service-card>
            @endforeach
        </div>

        <div class="mt-20 hidden md:block" data-image-carousel>
            <div class="reveal flex items-end justify-between gap-8">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-sea-700">A glimpse into our practice</p>
                    <h3 class="mt-3 font-display text-3xl font-semibold text-pine-950">Care in motion</h3>
                </div>
            </div>

            <div class="carousel-window reveal mt-8 overflow-hidden" style="--reveal-delay: 100ms">
                <div class="carousel-track flex w-max">
                    @foreach ([$galleryImages, $galleryImages] as $imageSet)
                        <div class="flex shrink-0 gap-5 pr-5">
                            @foreach ($imageSet as $image)
                                <button
                                    type="button"
                                    class="group relative block w-80 shrink-0 cursor-zoom-in overflow-hidden rounded-3xl bg-pine-100 text-left shadow-sm focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-sea-600"
                                    data-carousel-image
                                    data-image-src="{{ asset($image['src']) }}"
                                    data-image-alt="{{ $image['alt'] }}"
                                    aria-label="Enlarge image: {{ $image['alt'] }}"
                                >
                                    <img
                                        src="{{ asset($image['src']) }}"
                                        alt="{{ $image['alt'] }}"
                                        width="1200"
                                        height="900"
                                        loading="lazy"
                                        class="aspect-4/3 w-full object-cover transition duration-500 group-hover:scale-105 group-focus-visible:scale-105"
                                    >
                                    <span class="absolute inset-0 bg-linear-to-t from-pine-950/25 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-focus-visible:opacity-100"></span>
                                </button>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <dialog
                class="m-auto max-h-none max-w-none overflow-visible bg-transparent p-0 backdrop:bg-pine-950/85"
                data-carousel-dialog
                aria-label="Enlarged gallery image"
            >
                <div class="relative">
                    <img
                        src=""
                        alt=""
                        class="max-h-[75vh] max-w-[75vw] rounded-3xl object-contain shadow-2xl"
                        data-carousel-dialog-image
                    >
                    <button
                        type="button"
                        class="absolute -right-4 -top-4 grid size-11 place-items-center rounded-full bg-bone-50 text-pine-950 shadow-lg transition hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-400"
                        data-carousel-dialog-close
                        aria-label="Close enlarged image"
                    >
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M6 6l12 12M18 6 6 18"/>
                        </svg>
                    </button>
                </div>
            </dialog>
        </div>
    </div>
</section>
