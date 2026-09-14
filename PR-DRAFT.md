# Improve local SEO structure and appointment enquiries

Adds linked about, contact, services and patient-information pages, consistent metadata/MedicalClinic identity, gated production indexing and a safer synchronous enquiry journey, preserving Laravel/Livewire and the existing design.

## Review fixes and confirmed content

- Production preflight validates a private candidate against the existing server environment before maintenance, active reset or asset removal, bypasses stale caches, and checks the rebuilt effective cache before bringing the site online. Failures report configuration keys only. In-place deployment still needs backups and manual recovery.
- Service cards appear automatically for published services; the empty state offers a direct enquiry and `/services` has no redundant Explore self-link.
- Successful synchronous mail records success before cache bookkeeping. Cache-write failures cannot report a sending failure; real mail failures, replay protection and generic analytics deduplication remain tested. This is not guaranteed exactly-once delivery.
- Following the user's confirmation, all three service pages and patient information are published. Elize Strydom and Cheryl Myburgh both provide these services and hold physiotherapy degrees; patients are not expected to bring anything. About has visibly labelled profile placeholders; patient information has visibly labelled appointment/policy placeholders; service expectations await details in a labelled block. No invented fees, credentials, treatment claims or photos.
- Public contact defaults now use Surgiklin Studios, Unit 12, Koorsboom Ave, Glen Marais, Kempton Park, 1619; 011 391 3126; admin@danksandstrydom.co.za. The example enquiry inbox is updated, but runtime recipients still require explicit configuration. Maps and structured address remain gated pending entrance/pin verification.

## Validation

75 PHP tests / 323 assertions and 2 JavaScript tests passed. Pint, PHPStan (512 MB), production Vite build, shell syntax and diff checks passed; rebuilt assets are included. Chromium checks at 390px and 1440px cover empty/published services, about, patient information and all three service pages: correct cards/placeholders, no overflow or uncaught JavaScript errors. Mail testing was fake/mocked only.

## Remaining input and release steps

Provide the patient entrance, verified Google pin and HTTPS embed/directions links; confirm matching structured fields including province. Later supply approved biographies, photos, full qualifications, service expectations, appointment arrangements, fees/medical aid, referrals and cancellation policy to replace the visible placeholders. Editing guidance and the current fact sheet are in SEO-REVIEW.md.

Existing server environment values override the new defaults, including blank or stale values. An authorised operator must review contact/recipient values, the intended HTTPS origin, production/debug/indexing/canonical flags, configuration cache and host settings. Preflight still blocks an unverified location. No production configuration is overwritten automatically. For the first deployment, use the reviewed script from a separate trusted path before changing the active checkout. Google-account work and authorised delivery verification remain external; the existing dependency-audit follow-up remains open.

Existing draft PR updated only. No merge, deployment, live enquiry or Google-account changes.
