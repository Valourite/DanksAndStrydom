<section id="about" class="py-20 sm:py-28">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <x-site.section-heading eyebrow="Danks & Strydom" title="Speak to the practice">
            Ask about practitioner availability and the experience relevant to your needs.
        </x-site.section-heading>
        @if (isset(\App\Support\Site::pages()['about']))
        <a href="{{ route('about') }}" class="mt-8 inline-flex font-semibold text-sea-700 underline underline-offset-4">About the practice</a>
        @endif
        <div id="benefits" class="mt-10"><x-site.phone /></div>
    </div>
</section>
