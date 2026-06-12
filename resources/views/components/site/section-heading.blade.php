@props([
    'eyebrow' => null,
    'title' => '',
    'align' => 'center', // center | left
])

@php
    $isCenter = $align === 'center';
@endphp

<div {{ $attributes->class([
        'reveal max-w-2xl',
        'mx-auto text-center' => $isCenter,
        'text-left' => ! $isCenter,
    ]) }}>
    @if ($eyebrow)
        <p @class([
            'flex items-center gap-3 text-[0.68rem] font-semibold uppercase tracking-[0.28em] text-sea-600',
            'justify-center' => $isCenter,
        ])>
            <span class="h-px w-8 bg-sea-500/60"></span>
            {{ $eyebrow }}
            @if ($isCenter)
                <span class="h-px w-8 bg-sea-500/60"></span>
            @endif
        </p>
    @endif

    <h2 class="mt-6 text-balance font-display text-[2.1rem] font-medium leading-[1.12] tracking-tight text-pine-950 sm:text-[2.6rem] lg:text-5xl lg:leading-[1.08]">
        {{ $title }}
    </h2>

    @if (! empty(trim($slot)))
        <p @class([
            'mt-6 text-pretty text-base leading-relaxed text-pine-600 sm:text-lg',
            'mx-auto' => $isCenter,
        ])>
            {{ $slot }}
        </p>
    @endif
</div>
