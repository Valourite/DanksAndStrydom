# Improve local SEO and prepare complete content for clinical review

Adds linked pages, consistent metadata/MedicalClinic identity, safe indexing controls and a safer synchronous enquiry journey while preserving Laravel/Livewire and the design. Existing deployment preflight and mail/cache fixes remain intact.

## Latest content and review changes

- Applies the user's final Suite 102 / Surgiklin Studios / Glen Eagle Office Park address consistently, with supplied entrance, parking/access and hours. Retains the confirmed phone and email. Inspects the supplied Google Maps pin and uses its actual Share → Embed a map source; directions use the approved short link. No guessed pin or Monument Road map.
- Completes three service descriptions, patient preparation, booking/confirmation, follow-up, referral, payment, interim medical-aid and conditional cancellation wording. No treatment/outcome guarantees or invented claim handling.
- Replaces practitioner placeholders with finished text-only profiles and the supplied biographies. Uses Physiotherapist and only the confirmed generic degree information; no stock portraits or fabricated qualifications.
- Holds About, service detail and patient-information pages unpublished pending Cheryl Myburgh's final approval. Contact booking policies render only in review. Production drafts return 404 and are excluded from navigation/sitemaps; services retain the useful empty state.
- Adds HTTPS-only, password-protected staging review with hashed credentials, failed-attempt throttling, no-store/noindex responses and a request-scoped draft gate. Production cannot enable draft access through preview flags, credentials or query strings. No hosted staging deployment occurred.

## Validation

80 PHP tests / 378 assertions and 2 JavaScript tests passed. Pint, PHPStan (512 MB), production build, shell syntax and diff checks passed; committed assets rebuilt. Authenticated loopback staging browser checks at 390px and 1440px cover About, services, all three details, patient information and Contact: correct headings/cards, no placeholders or horizontal overflow. About visually inspected on desktop/mobile. Mail tests fake/mocked only.

## Remaining approval and operations

Only unresolved content/access items: Cheryl’s final clinical/biography/policy approval; exact qualifications; medical-aid claim handling; photos when available; Google ownership/account access. The current website origin is confirmed as https://danksandstrydom.co.za. Valourite handles hosting/configuration and coordinates Google work once access is established. Google currently shows older address formatting and closing time; reconcile through the authorised account owner.

SEO-REVIEW.md records the supplied facts, private preview configuration, publication steps and release checklist. Existing server environment overrides must be reviewed; this code never overwrites production configuration. Preflight remains an in-place-deployment safeguard, not atomic deployment or automatic rollback. Cache-based deduplication does not guarantee exactly-once mail delivery. The existing dependency-audit follow-up remains open.

Existing draft PR only. No merge, deployment, live enquiry or Google-account changes.
