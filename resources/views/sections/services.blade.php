@php($services = \App\Support\Site::services())
<section id="services" @class(['py-8' => request()->routeIs('services'), 'py-20 sm:py-28' => ! request()->routeIs('services')])>
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        @if (! request()->routeIs('services'))
            <x-site.section-heading eyebrow="Physiotherapy enquiries" title="Find the next step for you">
                Ask the practice about the care available for your needs.
            </x-site.section-heading>
        @endif
        @if ($services !== [])
            <div class="mt-8 grid gap-5 md:grid-cols-3" data-service-cards>
                @foreach ($services as $name => $service)
                    <x-site.service-card :title="$service['heading']" :href="route($name)">{{ $service['intro'] }}</x-site.service-card>
                @endforeach
            </div>
            @if (! request()->routeIs('services'))
                <a href="{{ route('services') }}" class="mt-6 inline-flex rounded-full border border-pine-900/20 px-6 py-3 font-semibold text-sea-700">Explore physiotherapy enquiries</a>
            @endif
        @else
            <div class="rounded-3xl border border-pine-900/10 bg-white p-6 sm:p-8 {{ request()->routeIs('services') ? '' : 'mt-8' }}" data-service-enquiry>
                <p class="max-w-2xl leading-relaxed text-pine-600">Tell the practice what you need help with and ask which appointment would be appropriate.</p>
                <a href="{{ route('contact') }}#contact" class="mt-5 inline-flex rounded-full bg-pine-900 px-6 py-3 font-semibold text-bone-50">Ask about an appointment</a>
            </div>
        @endif
    </div>
</section>
