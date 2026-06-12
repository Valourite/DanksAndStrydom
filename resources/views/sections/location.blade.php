{{-- ============================ LOCATION / MAP ============================ --}}
@php
    $practice = config('contact.practice');
    $mapUrl = $practice['map_embed_url'] ?? '';
@endphp

<section id="location" class="relative py-24 sm:py-28 lg:py-36">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Visit us" title="Find the practice">
            Easy to reach, easy to park, and a warm welcome when you arrive.
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
                    <p class="mt-2 text-sm text-pine-300">Personalised physiotherapy care, close to you.</p>

                    <dl class="mt-10 space-y-7">
                        <div>
                            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Location
                            </dt>
                            <dd class="mt-2 text-[0.95rem] leading-relaxed text-bone-50">{{ $practice['address'] }}</dd>
                        </div>

                        <div class="grid gap-7 sm:grid-cols-2">
                            <div>
                                <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Phone
                                </dt>
                                <dd class="mt-2 text-[0.95rem]">
                                    <a href="tel:{{ preg_replace('/\s+/', '', $practice['phone']) }}"
                                        class="text-bone-50 transition-colors hover:text-sea-300">{{ $practice['phone'] }}</a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Email
                                </dt>
                                <dd class="mt-2 text-[0.95rem]">
                                    <a href="mailto:{{ $practice['email'] }}"
                                        class="text-bone-50 transition-colors hover:text-sea-300">{{ $practice['email'] }}</a>
                                </dd>
                            </div>
                        </div>

                        <div>
                            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.24em] text-sea-300">Business
                                hours</dt>
                            <dd class="mt-3 divide-y divide-bone-50/10 border-y border-bone-50/10">
                                @foreach ($practice['hours'] as $day => $time)
                                    <div class="flex items-center justify-between gap-4 py-2.5 text-sm">
                                        <span class="text-pine-300">{{ $day }}</span>
                                        <span class="font-medium text-bone-50">{{ $time }}</span>
                                    </div>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Map panel --}}
                <div class="relative min-h-80 bg-bone-100 lg:min-h-full">
                    @if (!empty($mapUrl))
                        <iframe src="{{ $mapUrl }}" title="Map showing the location of {{ $practice['name'] }}"
                            class="absolute inset-0 h-full w-full" style="border:0;" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    @else
                        {{-- Polished placeholder until the real Google Maps embed URL is set --}}
                        <div
                            class="relative flex h-full min-h-80 flex-col items-center justify-center gap-5 overflow-hidden p-10 text-center">
                            {{-- faux map grid --}}
                            <div
                                class="pointer-events-none absolute inset-0 opacity-50 bg-[linear-gradient(var(--color-pine-100)_1px,transparent_1px),linear-gradient(90deg,var(--color-pine-100)_1px,transparent_1px)] bg-size-[42px_42px]">
                            </div>
                            <div
                                class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_45%,transparent_30%,var(--color-bone-100)_75%)]">
                            </div>
                            {{-- faux roads --}}
                            <svg class="pointer-events-none absolute inset-0 h-full w-full text-sea-200"
                                viewBox="0 0 400 300" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                <path d="M-10 220 C 90 180, 150 260, 410 150" stroke="currentColor" stroke-width="14"
                                    opacity="0.5" />
                                <path d="M120 -10 C 140 110, 90 200, 180 310" stroke="currentColor" stroke-width="9"
                                    opacity="0.4" />
                            </svg>

                            <span
                                class="relative flex h-16 w-16 items-center justify-center rounded-full bg-pine-950 text-sea-300 shadow-[0_18px_40px_-16px_rgba(10,31,27,0.6)]">
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 21s-7-5.2-7-11a7 7 0 1 1 14 0c0 5.8-7 11-7 11z" />
                                    <circle cx="12" cy="10" r="2.5" />
                                </svg>
                            </span>
                            <div class="relative">
                                <p class="font-display text-lg font-medium text-pine-950">Interactive map coming soon</p>
                                <p class="mx-auto mt-1.5 max-w-xs text-sm text-pine-500">
                                    Set <code
                                        class="rounded bg-white px-1.5 py-0.5 text-xs text-sea-700">CONTACT_MAP_EMBED_URL</code>
                                    to display the Google Maps embed here.
                                </p>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($practice['address']) }}"
                                target="_blank" rel="noopener"
                                class="group relative inline-flex items-center gap-2 rounded-full border border-pine-900/15 bg-white px-6 py-3 text-sm font-semibold text-pine-900 transition-all duration-300 hover:border-pine-950 hover:bg-pine-950 hover:text-bone-50">
                                Open in Google Maps
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M7 17 17 7M9 7h8v8" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>