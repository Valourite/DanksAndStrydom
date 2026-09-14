@props(['title', 'eyebrow'])
<section {{ $attributes->class('reveal flex h-full flex-col rounded-3xl border border-pine-900/8 bg-white p-8 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_24px_50px_-26px_rgba(10,31,27,0.35)]') }}>
    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sea-700">{{ $eyebrow }}</p>
    <h3 class="mt-5 font-display text-2xl font-medium leading-tight text-pine-950">{{ $title }}</h3>
    <p class="mt-5 flex-1 text-pretty font-display text-[1.05rem] leading-[1.6] text-pine-800">{{ $slot }}</p>
</section>
