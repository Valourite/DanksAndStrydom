@if (config('contact.practice.phone'))
    <a data-contact-action="phone" href="tel:{{ preg_replace('/[^+0-9]/', '', config('contact.practice.phone')) }}" class="inline-flex py-3 font-semibold underline underline-offset-4">Call {{ config('contact.practice.phone') }}</a>
@endif
