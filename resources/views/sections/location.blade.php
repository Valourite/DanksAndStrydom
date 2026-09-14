@php($practice = config('contact.practice'))
<section id="location" class="py-20 sm:py-28">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Visit" title="Glen Marais, Kempton Park">Find us at Surgiklin Studios in Glen Eagle Office Park.</x-site.section-heading>
        <div class="mt-10 rounded-3xl bg-pine-950 p-8 text-bone-50 sm:p-12">
            @if ($practice['address'])<p class="mb-4">{{ $practice['address'] }}</p>@endif
            @if ($practice['location_verified'])
                @if ($practice['directions_url'])
                    <a data-contact-action="directions" href="{{ $practice['directions_url'] }}" rel="noopener noreferrer" target="_blank" class="mt-4 inline-flex underline">Open directions</a>
                @endif
                @if ($practice['map_embed_url'])
                    <iframe src="{{ $practice['map_embed_url'] }}" title="Practice location map" class="mt-6 h-80 w-full rounded-2xl border-0" loading="lazy" referrerpolicy="no-referrer" allowfullscreen></iframe>
                @endif
            @endif
            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <div><h3 class="font-display text-xl">Finding the practice</h3><p class="mt-3 leading-relaxed">{{ $practice['arrival'] }}</p></div>
                <div><h3 class="font-display text-xl">Parking and access</h3><p class="mt-3 leading-relaxed">{{ $practice['access'] }}</p></div>
            </div>
            <x-site.phone />
            @if ($practice['email'])<p><a href="mailto:{{ $practice['email'] }}" class="break-all underline">{{ $practice['email'] }}</a></p>@endif
            @if ($practice['hours'])<p class="mt-4">{{ $practice['hours'] }}</p>@endif
        </div>
    </div>
</section>
