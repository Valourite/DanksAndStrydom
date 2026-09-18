@php($testimonials = \App\Support\Site::testimonials())
@if ($testimonials !== [])
    <section id="testimonials" aria-label="Patient testimonials" class="relative pb-4 sm:pb-8">
        <div class="mx-auto max-w-6xl px-5 sm:px-8">
            <x-site.section-heading title="What our patients say" />
            <div data-testimonial-cards class="mt-12 grid gap-5 lg:grid-cols-3">
                @foreach ($testimonials as $testimonial)
                    <x-site.testimonial-card :name="$testimonial['display_name']" :sample="$testimonial['sample']" :source-url="$testimonial['source_url']" style="--reveal-delay: {{ ($loop->index % 3) * 90 }}ms">
                        {{ $testimonial['quote'] }}
                    </x-site.testimonial-card>
                @endforeach
            </div>
        </div>
    </section>
@endif
