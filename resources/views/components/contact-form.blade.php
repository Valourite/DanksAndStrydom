<?php

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|min:2|max:120')]
    public string $name = '';

    #[Validate('required|email:rfc|max:160')]
    public string $email = '';

    #[Validate('nullable|string|max:40|regex:/^[0-9\s\-\+\(\)]*$/')]
    public string $phone = '';

    #[Validate('nullable|string|max:120')]
    public string $service = '';

    #[Validate('required|string|min:10|max:2500')]
    public string $message = '';

    #[Locked]
    public bool $sent = false;

    public string $website = '';

    #[Locked]
    public string $submissionId = '';

    public function mount(): void
    {
        $this->submissionId = (string) Str::uuid();
    }

    public function submit(): void
    {
        $this->resetErrorBag('form');
        if ($this->sent || $this->website !== '') {
            return;
        }
        $key = 'contact:'.hash('sha256', (string) request()->ip());
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('form', 'Too many attempts. Please try again later or call the practice.');
            return;
        }
        RateLimiter::hit($key, 600);
        $validated = $this->validate();

        $recipients = config('contact.recipients', []);

        if (empty($recipients)) {
            Log::warning('Contact form submitted but no CONTACT_MAIL_TO recipients are configured.');
            $this->addError('form', 'We\'re unable to send messages right now. Please call us instead.');

            return;
        }

        $lock = Cache::lock('enquiry-lock:'.$this->submissionId, 120);
        if (! $lock->get()) {
            return;
        }
        try {
            if (Cache::has('enquiry-sent:'.$this->submissionId)) {
                $this->sent = true;
                return;
            }
            // The hosting environment has no queue worker; preserve synchronous mail.
            Mail::to($recipients)->send(new ContactFormSubmitted(
                data: [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? '',
                    'service' => $validated['service'] ?? '',
                    'message' => $validated['message'],
                ],
                submittedAt: now(),
            ));
            Cache::put('enquiry-sent:'.$this->submissionId, true, now()->addDay());
        } catch (\Throwable $e) {
            Log::error('Contact form mail failed.', ['exception_type' => $e::class]);
            $this->addError('form', 'Something went wrong sending your message. Please try again or call us.');

            return;
        } finally {
            $lock->release();
        }

        $this->dispatch('enquiry-accepted', id: $this->submissionId);
        $this->reset(['name', 'email', 'phone', 'service', 'message']);
        $this->sent = true;
    }

    public function sendAnother(): void
    {
        $this->sent = false;
        $this->submissionId = (string) Str::uuid();
    }
}; ?>

<div class="relative">
    <div class="overflow-hidden rounded-[2.5rem] border border-pine-900/8 bg-white p-7 shadow-[0_40px_90px_-50px_rgba(10,31,27,0.5)] sm:p-10">

        @if ($sent)
            {{-- Success state --}}
            <div class="flex flex-col items-center py-24 sm:py-28 lg:py-36 text-center" wire:key="contact-success" role="status" tabindex="-1" data-enquiry-success>
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-sea-100 text-sea-700">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                </span>
                <h3 class="mt-7 font-display text-2xl font-medium tracking-tight text-pine-950">Thank you — <em class="text-sea-600">message sent.</em></h3>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-pine-500">
                    Your enquiry has been accepted for sending to the practice. Your appointment is not confirmed until the practice confirms it.
                </p>
                <button type="button" wire:click="sendAnother"
                        class="mt-9 inline-flex items-center gap-2 rounded-full border border-pine-900/15 px-6 py-3 text-sm font-semibold text-pine-900 transition-all duration-300 hover:border-pine-950 hover:bg-pine-950 hover:text-bone-50">
                    Send another message
                </button>
            </div>
        @else
            <form wire:submit="submit" novalidate class="space-y-6">
                <div>
                    <h3 class="font-display text-2xl font-medium tracking-tight text-pine-950">Send us a message</h3>
                    <p class="mt-2 text-sm text-pine-500">Fields marked <span class="text-sea-600">*</span> are required.</p>
                </div>

                @error('form')
                    <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3.5 text-sm text-red-700" role="alert">
                        <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16.5h.01"/></svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <div class="hidden" aria-hidden="true">
                    <label for="cf-website">Leave this field empty</label>
                    <input id="cf-website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
                </div>
                {{-- Name + Phone --}}
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="cf-name" class="block text-xs font-semibold uppercase tracking-[0.14em] text-pine-700">Name <span class="text-sea-600">*</span></label>
                        <input id="cf-name" type="text" wire:model="name" autocomplete="name" required aria-describedby="cf-name-error"
                               class="mt-2 w-full rounded-xl border-0 bg-bone-100 px-4 py-3.5 text-[0.95rem] text-pine-950 ring-1 ring-inset @error('name') ring-red-300 @else ring-transparent @enderror transition duration-200 placeholder:text-pine-300 focus:bg-white focus:ring-2 focus:ring-sea-500 "
                               placeholder="Your full name">
                        @error('name') <p id="cf-name-error" role="alert" class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="cf-phone" class="block text-xs font-semibold uppercase tracking-[0.14em] text-pine-700">Phone</label>
                        <input id="cf-phone" type="tel" wire:model="phone" autocomplete="tel"
                               class="mt-2 w-full rounded-xl border-0 bg-bone-100 px-4 py-3.5 text-[0.95rem] text-pine-950 ring-1 ring-inset @error('phone') ring-red-300 @else ring-transparent @enderror transition duration-200 placeholder:text-pine-300 focus:bg-white focus:ring-2 focus:ring-sea-500 "
                               placeholder="+27 00 000 0000">
                        @error('phone') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="cf-email" class="block text-xs font-semibold uppercase tracking-[0.14em] text-pine-700">Email <span class="text-sea-600">*</span></label>
                    <input id="cf-email" type="email" wire:model="email" autocomplete="email" required aria-describedby="cf-email-error"
                           class="mt-2 w-full rounded-xl border-0 bg-bone-100 px-4 py-3.5 text-[0.95rem] text-pine-950 ring-1 ring-inset @error('email') ring-red-300 @else ring-transparent @enderror transition duration-200 placeholder:text-pine-300 focus:bg-white focus:ring-2 focus:ring-sea-500 "
                           placeholder="you@example.com">
                    @error('email') <p id="cf-email-error" role="alert" class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Message --}}
                <div>
                    <label for="cf-message" class="block text-xs font-semibold uppercase tracking-[0.14em] text-pine-700">Message <span class="text-sea-600">*</span></label>
                    <textarea id="cf-message" rows="5" wire:model="message" required aria-describedby="cf-message-error"
                              class="mt-2 w-full resize-y rounded-xl border-0 bg-bone-100 px-4 py-3.5 text-[0.95rem] text-pine-950 ring-1 ring-inset @error('message') ring-red-300 @else ring-transparent @enderror transition duration-200 placeholder:text-pine-300 focus:bg-white focus:ring-2 focus:ring-sea-500 "
                              placeholder="Tell us a little about how we can help…"></textarea>
                    @error('message') <p id="cf-message-error" role="alert" class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col items-start gap-5 pt-1">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-3 rounded-full bg-pine-900 py-3.5 pl-7 pr-3.5 text-sm font-semibold text-bone-50 shadow-[0_18px_40px_-18px_rgba(10,31,27,0.6)] transition-all duration-300 hover:bg-sea-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sea-600 disabled:cursor-not-allowed disabled:opacity-60"
                            wire:loading.attr="disabled" wire:target="submit">
                        <span wire:loading.remove wire:target="submit" class="inline-flex items-center gap-3">
                            Send message
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-bone-50/15">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                            </span>
                        </span>
                        <span wire:loading wire:target="submit" class="inline-flex items-center gap-2 py-1.5">
                            <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" class="opacity-25"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                            Sending…
                        </span>
                    </button>

                    <p class="max-w-sm text-xs leading-relaxed text-pine-400">
                        Your contact details and message are emailed to the practice to handle this enquiry. Please avoid including detailed clinical information.
                    </p>
                </div>
            </form>
        @endif
    </div>
</div>
