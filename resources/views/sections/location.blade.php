{{-- ============================ LOCATION / MAP ============================ --}}
@php
    $practice = config('contact.practice');
    $mapUrl = $practice['map_embed_url'] ?? '';
@endphp

<section id="location" class="relative py-24 sm:py-28 lg:py-36">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Visit us" title="Find the practice">
            Surgiklin Studios, Glen Eagle Office Park, Glen Marais, Kempton Park.
        </x-site.section-heading>

        <div
            class="reveal mt-14 overflow-hidden rounded-[2.5rem] border border-pine-900/8 bg-white shadow-[0_40px_90px_-50px_rgba(10,31,27,0.5)]">
            <div class="grid lg:grid-cols-[0.9fr_1.1fr]">

                {{-- Details panel --}}
                <div class="grain relative isolate overflow-hidden bg-pine-950 p-8 text-bone-50 sm:p-10 lg:p-12">
                    <div
                        class="pointer-events-none absolute -right-16 -top-16 -z-10 h-56 w-56 rounded-full bg-sea-600/25 blur-3xl">
                    </div>

                    <h3 class="font-display text-[1.7rem] font-medium tracking-tight">{{ $practice['name'] }}</h3>
                    <p class="mt-2 text-sm text-pine-300">Suite 102 · Unit 12</p>

                    <dl class="mt-10 space-y-7">
                        <div>
                            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Location
                            </dt>
                            <dd class="mt-2 text-[0.95rem] leading-relaxed text-bone-50">{{ $practice['address'] }}</dd>
                        </div>

                        <div class="grid gap-7">
                            <div>
                                <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Phone
                                </dt>
                                <dd class="mt-2 break-words text-[0.95rem]">
                                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $practice['phone']) }}"
                                        data-contact-action="phone" class="text-bone-50 transition-colors hover:text-sea-300">{{ $practice['phone'] }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Email
                                </dt>
                                <dd class="mt-2 break-words text-[0.95rem]">
                                    <a href="mailto:{{ $practice['email'] }}"
                                        class="text-bone-50 transition-colors hover:text-sea-300">{{ $practice['email'] }}</a>
                                </dd>
                            </div>
                        </div>

                        <div>
                            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Business
                                hours</dt>
                            <dd class="mt-3 divide-y divide-bone-50/10 border-y border-bone-50/10">
                                <p class="py-3 text-sm leading-relaxed text-bone-50">{{ $practice['hours'] ?: 'Contact the practice for availability.' }}</p>
                            </dd>
                        </div>
                    </dl>
                    @if ($practice['location_verified'] && $practice['directions_url'])
                        <a data-contact-action="directions" href="{{ $practice['directions_url'] }}" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex items-center rounded-full border border-bone-50/25 px-6 py-3 text-sm font-semibold text-bone-50 hover:bg-bone-50/10">Open directions</a>
                    @endif
                </div>

                {{-- Map panel --}}
                <div class="relative min-h-80 bg-bone-100 lg:min-h-full">
                    @if ($practice['location_verified'] && $mapUrl)
                        <iframe src="{{ $mapUrl }}" title="Practice location map"
                            class="absolute inset-0 h-full w-full" style="border:0;" loading="lazy"
                            referrerpolicy="no-referrer" allowfullscreen></iframe>
                    @else
                        <div class="flex h-full min-h-80 items-center justify-center p-10 text-center">
                            <p class="max-w-xs font-display text-2xl text-pine-900">Contact the practice for directions before travelling.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-10 grid gap-8 sm:grid-cols-2">
            <div><h3 class="font-display text-xl text-pine-950">Finding the entrance</h3><p class="mt-3 text-sm leading-relaxed text-pine-600">{{ $practice['arrival'] }}</p></div>
            <div><h3 class="font-display text-xl text-pine-950">Parking and access</h3><p class="mt-3 text-sm leading-relaxed text-pine-600">{{ $practice['access'] }}</p></div>
        </div>
    </div>
</section>