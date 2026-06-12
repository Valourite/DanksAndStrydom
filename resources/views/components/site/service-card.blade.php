@props([
    'title' => '',
    'icon' => 'pulse',
    'index' => null,
])

@php
    // Inline stroke icons (24×24) keyed by name.
    $icons = [
        'pulse'    => '<path d="M3 12h4l2-7 4 14 2-7h6"/>',
        'spine'    => '<path d="M12 3v18"/><path d="M9 6h6"/><path d="M8 10h8"/><path d="M9 14h6"/><path d="M10 18h4"/>',
        'recovery' => '<path d="M3 12a9 9 0 1 0 9-9"/><path d="M3 4v5h5"/><path d="M12 7v5l3 2"/>',
        'joint'    => '<circle cx="7" cy="7" r="3"/><circle cx="17" cy="17" r="3"/><path d="M9.5 9.5l5 5"/>',
        'mobility' => '<circle cx="12" cy="5" r="2"/><path d="M5 9l4 2 3-1 3 1 4-2"/><path d="M9 11l-2 9"/><path d="M15 11l2 9"/>',
        'shield'   => '<path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9.5 12l1.8 1.8L15 10"/>',
        'chronic'  => '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>',
        'program'  => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M9 16h4"/>',
    ];
    $path = $icons[$icon] ?? $icons['pulse'];
@endphp

<article {{ $attributes->class([
        'reveal group relative flex h-full flex-col overflow-hidden rounded-3xl border border-pine-900/8 bg-white p-7 transition-all duration-500',
        'hover:-translate-y-1 hover:border-pine-950 hover:bg-pine-950 hover:shadow-[0_28px_60px_-28px_rgba(10,31,27,0.55)]',
    ]) }}>

    <div class="flex items-start justify-between">
        <span class="flex h-12 w-12 items-center justify-center rounded-full border border-pine-900/10 text-pine-800 transition-all duration-500 group-hover:border-sea-400/40 group-hover:text-sea-300">
            <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                {!! $path !!}
            </svg>
        </span>
        @if ($index !== null)
            <span class="font-display text-sm italic text-pine-300 transition-colors duration-500 group-hover:text-sea-400/70">
                {{ str_pad($index, 2, '0', STR_PAD_LEFT) }}
            </span>
        @endif
    </div>

    <h3 class="mt-7 font-display text-[1.15rem] font-medium leading-snug tracking-tight text-pine-950 transition-colors duration-500 group-hover:text-bone-50">
        {{ $title }}
    </h3>

    <p class="mt-2.5 flex-1 text-sm leading-relaxed text-pine-600 transition-colors duration-500 group-hover:text-pine-200">
        {{ $slot }}
    </p>

    <span class="mt-6 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-sea-700 opacity-0 transition-all duration-500 group-hover:text-sea-300 group-hover:opacity-100">
        Enquire
        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </span>
</article>
