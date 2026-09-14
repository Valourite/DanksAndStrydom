@php($services = \App\Support\Site::services())
<section id="services" @class(['relative', 'py-24 sm:py-28 lg:pt-36' => ! request()->routeIs('services'), 'pb-20' => request()->routeIs('services')])>
    <div class="absolute inset-0 -z-10 bg-linear-to-b from-bone-50 via-white to-bone-50"></div>
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        @unless (request()->routeIs('services'))
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <x-site.section-heading eyebrow="What we do" align="left" title="Physiotherapy in Glen Marais">
                    Back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation with Elize Strydom and Cheryl Myburgh.
                </x-site.section-heading>
                <a href="{{ route('services') }}" class="reveal inline-flex w-fit shrink-0 items-center gap-2 text-sm font-semibold text-pine-900 underline underline-offset-4">Explore our services</a>
            </div>
        @endunless
        @if ($services !== [])
            <div data-service-cards class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $name => $service)
                    <x-site.service-card :title="$service['card_title'] ?? $service['heading']" :href="route($name)" :index="$loop->iteration" :icon="$service['service_icon'] ?? 'pulse'">
                        {{ $service['card_description'] ?? $service['intro'] }}
                    </x-site.service-card>
                @endforeach
            </div>
        @else
            <div data-service-enquiry class="mt-10 flex flex-col justify-between gap-6 rounded-3xl border border-pine-900/8 bg-white p-8 sm:flex-row sm:items-center sm:p-10">
                <p class="max-w-xl text-base leading-relaxed text-pine-600">Contact the practice to discuss your physiotherapy needs and arrange an assessment.</p>
                <a href="{{ route('contact') }}#contact" class="inline-flex shrink-0 items-center justify-center rounded-full bg-pine-900 px-6 py-3 text-sm font-semibold text-bone-50">Request an appointment</a>
            </div>
        @endif
        @if (request()->routeIs('home'))
            <div data-practice-images class="mt-20 hidden gap-5 md:grid md:grid-cols-3" aria-label="Physiotherapy illustrations">
                @foreach (['back_strapping.webp' => 'Physiotherapy illustration: taping of a shoulder and upper back', 'valf_physio.webp' => 'Physiotherapy illustration: treatment of the lower leg', 'knee_strapping.webp' => 'Physiotherapy illustration: taping around a knee'] as $image => $alt)
                    <figure class="reveal overflow-hidden rounded-3xl bg-pine-100 shadow-sm">
                        <img src="{{ asset('images/'.$image) }}" alt="{{ $alt }}" width="1200" height="900" loading="lazy" class="aspect-4/3 w-full object-cover">
                    </figure>
                @endforeach
            </div>
        @endif
    </div>
</section>
