@props(['name' => '', 'sourceUrl' => null, 'sample' => false])

<figure {{ $attributes->class(['reveal flex h-full flex-col rounded-3xl border border-ink-900/8 bg-card p-8']) }}>
    @if ($sample)
        <p class="mb-6 text-xs font-semibold leading-relaxed text-link">Sample testimonial — replace before publishing</p>
    @endif
    <span aria-hidden="true" class="-mt-2 block select-none font-display text-6xl font-medium leading-none text-accent-300">&ldquo;</span>
    <blockquote class="mt-1 flex-1">
        <p class="text-pretty font-display text-[1.05rem] font-normal leading-[1.6] text-ink-800">{{ $slot }}</p>
    </blockquote>
    <figcaption class="mt-8 border-t border-ink-900/8 pt-5">
        <p class="text-sm font-semibold text-ink-900">{{ $name }}</p>
        @if ($sourceUrl)
            <a href="{{ $sourceUrl }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex text-sm text-link underline underline-offset-4">Read original testimonial<span class="sr-only"> by {{ $name }}</span></a>
        @endif
    </figcaption>
</figure>
