@props([
    'name' => '',
    'detail' => '',
    'rating' => 5,
])

<figure {{ $attributes->class([
        'reveal flex h-full flex-col rounded-3xl border border-pine-900/8 bg-white p-8 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_24px_50px_-26px_rgba(10,31,27,0.35)]',
    ]) }}>

    {{-- Oversized serif quote mark --}}
    <span aria-hidden="true" class="-mt-2 block select-none font-display text-6xl font-medium leading-none text-sea-300">&ldquo;</span>

    <blockquote class="mt-1 flex-1">
        <p class="text-pretty font-display text-[1.05rem] font-normal leading-[1.6] text-pine-800">{{ $slot }}</p>
    </blockquote>

    <figcaption class="mt-8 flex items-end justify-between gap-4 border-t border-pine-900/8 pt-5">
        <div class="leading-tight">
            <p class="text-sm font-semibold text-pine-950">{{ $name }}</p>
            <p class="mt-1 text-xs uppercase tracking-[0.14em] text-pine-400">{{ $detail }}</p>
        </div>
        <div class="flex items-center gap-0.5 text-sand-400" aria-label="{{ $rating }} out of 5 stars">
            @for ($i = 0; $i < 5; $i++)
                <svg class="h-3.5 w-3.5 {{ $i < $rating ? 'fill-current' : 'fill-pine-100' }}" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M10 1.5l2.6 5.3 5.9.86-4.25 4.14 1 5.86L10 15.9l-5.25 2.76 1-5.86L1.5 7.66l5.9-.86z"/>
                </svg>
            @endfor
        </div>
    </figcaption>
</figure>
