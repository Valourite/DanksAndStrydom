<section id="services" class="py-20 sm:py-28">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Physiotherapy enquiries" title="Find the next step for you">
            Ask the practice about the care available for your needs.
        </x-site.section-heading>
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach (\App\Support\Site::pages() as $name => $service)
                @if (str_starts_with($service['path'], '/services/'))
                    <x-site.service-card :title="$service['heading']" :href="route($name)">{{ $service['intro'] }}</x-site.service-card>
                @endif
            @endforeach
        </div>
        <a href="{{ route('services') }}" class="inline-flex rounded-full border border-pine-900/20 px-6 py-3 font-semibold text-sea-700">Explore physiotherapy enquiries</a>
    </div>
</section>
