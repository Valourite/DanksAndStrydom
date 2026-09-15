# Local SEO, eight public services and preserved blue website design

Adds an eight-service patient journey with consistent metadata, canonical URLs, clinic structured data, sitemap/indexing controls and protected synchronous enquiry delivery. Preserves the restored original layouts, typography, image compositions and current blue palette.

## Animation and content refinement

Verified reference `42880b2` and compared its JS/CSS/Blade. Restored disconnected 30px/850ms scroll entrances and 0/90/180/270ms service-card staggers; applied consistent entrances to internal content. Content stays visible before observation or if JavaScript fails. Existing hover, drift, header and mobile-navigation interactions remain; parallax now responds to reduced-motion and mobile changes. The approved static illustration strip remains unchanged instead of restoring the removed carousel.

Rewrote all eight services around distinct patient questions, assessment focus, care and follow-up. Removed repeated service-page administration in favour of Patient Information, added relevant related links to the original three services, and separated homepage practitioner/first-visit/location/appointment content. Clinical background uses NHS/CSP sources; references and their limits are recorded in SEO-REVIEW.md. Practice-specific facts remain those supplied by the user.

## Public content and optional information

- All eight service pages, About and Patient Information are published in configuration; Contact’s booking information is now normal public content. Home and the hub expose eight ordered crawlable cards, and indexable production discovery contains all 13 URLs.
- The user waived Cheryl’s content approval step. Missing optional facts do not prevent publication. No live site changes occur until a separately authorised merge/deployment.
- Names, titles and editable draft biographies based only on supplied degree/experience facts are public. Cheryl’s equine experience is biographical, not a practice service. Exact qualifications, universities, languages, longer biographies and approved portraits have empty/null fields with supply instructions in `config/site.php`.
- Additional optional fee/payment/medical-aid/missed-appointment facts are similarly stored without invented policies. `CONTENT-TODO.md` lists every key, what to supply, its eventual location, confirmed facts and external release tasks.
- Public pages hide incomplete optional fields and portraits cleanly. No missing-information notices appear in any environment; outstanding facts stay in comments and CONTENT-TODO.md.

## Preserved safeguards

The website Basic Auth gate and unused credentials/configuration are removed. Local and staging pages open anonymously while staying noindex, with crawling disallowed and an empty sitemap. Staging is accessible to anyone with its URL; noindex is not access protection. Deployment-token authentication is unchanged. Publication gating remains available if a page is disabled later. The verified location gate, canonical configuration, synchronous mail, replay protection, generic analytics deduplication and production deployment preflight remain intact.

The original design was restored from Git reference `42880b2`; backup branch `backup/seo-before-layout-restoration-2026-09-14` preserves the earlier SEO work. The central blue theme retains accessible text and focus states. Unsupported testimonials, credentials and unconfirmed promotional claims were not restored.

## Validation

95 PHP tests / 953 assertions and 4 JavaScript tests pass, plus Pint, PHPStan, production asset build, shell syntax and diff checks. Browser scrolled all 13 pages at 390px and 1440px: no overflow, one H1 each, eligible reveals triggered. Verified card hover/lift, header/parallax, service navigation and mobile toggle/Escape/focus/link-close. With scripts blocked in the temporary loopback QA transport, all pages remained readable at both widths. Assets rebuilt; fake/mocked mail only.

Reduced-motion and missing/throwing observer paths have automated coverage, with reduced-motion CSS retained. The browser tool cannot emulate OS motion preference, so an actual reduced-motion browser session remains a manual verification limitation. The Livewire form still requires JavaScript; no-JS checks cover content and links. No hosted staging/production testing, merge or deployment.

## Remaining release work

Optional content is tracked in `CONTENT-TODO.md`; it is not a release blocker. Valourite still needs to verify server environment overrides, effective cached production indexing/canonical settings, recipients and contact/location values, and obtain Google-account access for external listing/Search Console work. Existing preflight checks an in-place deployment; it does not provide an atomic release or automatic rollback. Cache-based deduplication does not guarantee exactly-once email delivery. Existing dependency-audit follow-up remains open.

No merge, deployment, live enquiry, production-setting change or Google-account modification.
