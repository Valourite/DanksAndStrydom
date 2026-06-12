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
@endphp

<section id="services" class="relative py-24 sm:py-28 lg:py-36">
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
    </div>
</section>
