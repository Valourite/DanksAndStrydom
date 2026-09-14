<x-layouts.app :title="$page['title']" :description="$page['description']" :canonical="\App\Support\Site::url($page['path'])">
    <section @class(['pt-36 sm:pt-44', 'pb-8' => request()->routeIs('services'), 'pb-16' => ! request()->routeIs('services')])>
        <div class="mx-auto max-w-6xl px-5 sm:px-8">
            <a href="{{ route('home') }}" class="text-sm text-sea-700 underline">Home</a>
            <h1 class="mt-8 max-w-3xl font-display text-4xl leading-tight text-pine-950 sm:text-6xl">{{ $page['heading'] }}</h1>
            <p class="mt-7 max-w-2xl text-lg leading-relaxed text-pine-600">{{ $page['intro'] }}</p>
            <div class="mt-8 flex flex-wrap items-center gap-6">
                <a href="{{ route('contact') }}#contact" class="rounded-full bg-pine-900 px-6 py-3 font-semibold text-bone-50">Request an appointment</a>
                <x-site.phone />
            </div>
        </div>
    </section>
    @if (request()->routeIs('services')) @include('sections.services') @endif
    @php($sections = $page['sections'] + (\App\Support\Site::reviewing() ? ($page['review_sections'] ?? []) : []))
    @if ($sections !== [])
    <div class="mx-auto grid max-w-6xl gap-8 px-5 pb-16 sm:px-8 md:grid-cols-2">
        @foreach ($sections as $heading => $body)
            <section class="rounded-3xl border border-pine-900/10 bg-white p-8">
                <h2 class="font-display text-2xl">{{ $heading }}</h2>
                <p class="mt-4 leading-relaxed text-pine-600">{{ $body }}</p>
            </section>
        @endforeach
    </div>
    @endif
    @if (! empty($page['practitioners']))
        <div class="mx-auto grid max-w-6xl gap-8 px-5 pb-16 sm:px-8 md:grid-cols-2">
            @foreach ($page['practitioners'] as $practitioner)
                <section data-practitioner class="rounded-3xl border border-pine-900/10 bg-white p-8">
                    <h2 class="font-display text-2xl">{{ $practitioner['name'] }}</h2>
                    <p class="mt-4 font-semibold text-sea-700">{{ $practitioner['title'] }}</p>
                    <p class="mt-4 leading-relaxed text-pine-600">{{ $practitioner['biography'] }}</p>
                </section>
            @endforeach
        </div>
    @endif
    <nav aria-label="Related information" class="mx-auto flex max-w-6xl flex-wrap gap-6 px-5 pb-12 sm:px-8">
        @foreach (\App\Support\Site::pages() as $name => $related)
            @if (! request()->routeIs($name))
                <a href="{{ route($name) }}" class="font-semibold text-sea-700 underline underline-offset-4">{{ $related['heading'] }}</a>
            @endif
        @endforeach
    </nav>
    @if (request()->routeIs('contact', 'patient-information'))
        @include('sections.location')
    @endif
    @if (request()->routeIs('contact'))
        @include('sections.contact')
    @endif
</x-layouts.app>
