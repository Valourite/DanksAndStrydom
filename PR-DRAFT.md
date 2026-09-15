# Local SEO, eight public services and preserved blue website design

Adds an eight-service patient journey with consistent metadata, canonical URLs, clinic structured data, sitemap/indexing controls and protected synchronous enquiry delivery. Preserves the restored original layouts, typography, image compositions and current blue palette.

## Public content and optional information

- All eight service pages, About and Patient Information are published in configuration; Contact’s booking information is now normal public content. Home and the hub expose eight ordered crawlable cards, and indexable production discovery contains all 13 URLs.
- The user waived Cheryl’s content approval step. Missing optional facts do not prevent publication. No live site changes occur until a separately authorised merge/deployment.
- Existing names, titles, physiotherapy-degree statements and short biographies remain public. Exact qualifications, universities, languages, longer biographies and approved portraits have empty/null fields with supply instructions in `config/site.php`.
- Additional optional fee/payment/medical-aid/missed-appointment facts are similarly stored without invented policies. `CONTENT-TODO.md` lists every key, what to supply, its eventual location, confirmed facts and external release tasks.
- Public pages hide incomplete optional fields and portraits cleanly. Clearly labelled missing-information notes appear only in authenticated staging and never enter metadata or structured data.

## Preserved safeguards

HTTPS Basic-auth staging preview remains private/no-store and noindex, including its empty sitemap. Production ignores preview flags and credentials. Publication gating remains available if a page is disabled later. The verified location gate, canonical configuration, synchronous mail, replay protection, generic analytics deduplication and production deployment preflight remain intact.

The original design was restored from Git reference `42880b2`; backup branch `backup/seo-before-layout-restoration-2026-09-14` preserves the earlier SEO work. The central blue theme retains accessible text and focus states. Unsupported testimonials, credentials and unconfirmed promotional claims were not restored.

## Validation

91 PHP tests / 657 assertions and 2 JavaScript tests pass. Pint, PHPStan (serial debug mode), production asset build, shell syntax and diff checks pass. Tests cover default unauthenticated production access, all service-card destinations, sitemap/metadata, optional fields and incomplete photos, escaping, placeholder exclusion from public HTML/head/schema, and preserved staging authentication/noindex. Rebuilt production assets included. Mail tests use fakes/mocks only.

## Remaining release work

Optional content is tracked in `CONTENT-TODO.md`; it is not a release blocker. Valourite still needs to verify server environment overrides, effective cached production indexing/canonical settings, recipients and contact/location values, and obtain Google-account access for external listing/Search Console work. Existing preflight checks an in-place deployment; it does not provide an atomic release or automatic rollback. Cache-based deduplication does not guarantee exactly-once email delivery. Existing dependency-audit follow-up remains open.

Browser checks at 390px and 1440px covered the full public inventory: one H1, no horizontal overflow, eight linked cards on home/services, and no public placeholder labels. Public About profiles were visually checked without portraits; staging rejected unauthenticated browser access. Authenticated placeholder rendering is covered by the feature tests. No merge, deployment, live enquiry, production-setting change or Google-account modification.
