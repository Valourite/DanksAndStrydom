# Improve local SEO structure and appointment enquiries

The existing single-page site uses generic local metadata, a Physiotherapy schema type, non-link service CTAs and conflicting/default location information. This change introduces named about/contact/services destinations and a reusable inventory for the three priority service pages and patient information, with per-page metadata, stable MedicalClinic identity, environment-aware canonicals, robots and sitemaps.

Unconfirmed clinical/service/policy copy remains unpublished (404 and absent from navigation/discovery). Testimonials, counters and operational promises without provenance are withheld. Approved location/contact configuration is required before release. The current Laravel/Livewire stack, visual identity and synchronous enquiry delivery remain; the form gains spam/replay protection and a disabled generic analytics adapter with no personal information.

Validation: 36 PHP tests / 161 assertions and 2 JS tests passed; Pint, PHPStan (512 MB), Vite build, route/config caching and shell syntax passed. Local Chromium desktop/mobile pages, menu, form validation and log-only acceptance were checked. See SEO-REVIEW.md for factual gaps, audit reconciliation, local performance limitations, hosting instructions, rollback and Google/directory checklists.

Draft review only. No deployment or live mail test performed. Complete practice-content/location review, configure production indexing flags and separately authorise release. Existing npm dependencies need a separate audit follow-up; npm ci reported four findings. Apache hosting changes and Google-account work are prepared instructions, not applied changes.
