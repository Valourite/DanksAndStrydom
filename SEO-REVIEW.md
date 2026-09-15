# Local SEO and enquiry implementation review


## Current publication status — 15 September 2026

The user authorised all eight service pages, About and Patient Information for public release and waived Cheryl’s approval step. Contact’s former preview sections are normal public content. The unchanged indexable production sitemap now lists 13 URLs (home plus the 12-page inventory), with eight crawlable service cards on home and the hub. The homepage service count follows the published inventory.

`CONTENT-TODO.md` records exact file/configuration keys, inputs and display destinations for optional practitioner and policy details. Confirmed short biographies remain public. Unknown qualifications, universities, languages, expanded biographies, portraits and policy additions use null/empty values, with explanatory configuration comments. Public views omit incomplete optional content and photos; missing-information labels appear only in authenticated staging body content and never in metadata or structured data. There is no additional content approval gate.

Validation: **91 PHP tests / 657 assertions**, **2 JavaScript tests**, Pint, PHPStan (serial debug mode because the restricted runner could not start its normal worker), production asset build, shell syntax and diff checks passed. Tests verify the default public inventory and ordered card destinations without authentication, production sitemap inclusion and metadata, later unpublication gating, optional-content escaping/omission, incomplete portrait omission, preview-only labels, staging authentication and staging noindex/empty sitemap. Browser checks at 390px and 1440px covered the full public inventory: one H1, no horizontal overflow, eight linked cards on home/services, and no public placeholder labels. Public About profiles were visually checked without portraits; staging rejected unauthenticated browser access. Authenticated placeholder rendering is covered by the feature tests. No merge, deployment, live enquiry or Google-account change.



## Blue colour theme

Applies the requested blue palette through central Tailwind theme tokens: deep-blue buttons, navy sections/overlays, soft-white and pale-blue surfaces, readable blue-grey text, darker teal-blue links and decorative cyan. Preserves the existing wordmark, imagery, typography, layout, content, navigation, publication flags and all application/SEO behaviour. Updates shadow colours, gradients, selection, placeholders, hover and keyboard focus; semantic red errors and green success remain separate.

Validation: **87 PHP tests / 483 assertions**, **2 JavaScript tests**, Pint, PHPStan, production asset build, shell syntax and diff checks passed. Built with the bundled supported Node runtime (the system Node 18 is too old for Vite 8). Desktop homepage geometry/fonts matched the pre-theme capture. Browser checks at **390px and 1440px** covered all eight service pages, About, patient information and Contact, with no overflow or broken loaded images. Screenshots inspected homepage, service grid/hover, internal page, dark sections/footer, mobile navigation and form validation/focus. Public service gating remains intact. Success was checked using synthetic input and local log-only mail; no live enquiries.

Contrast ratios: white primary-button text **9.34:1** (hover **11.44:1**), light-background links **5.37:1**, secondary text **5.60:1**, light cyan on navy **8.96:1**, and muted footer text **6.13:1**. Keyboard focus has a dark outline on light surfaces and a white edge for navy surfaces. Content approval was subsequently waived; operational release requirements remain unchanged. No merge or deployment.

Prepared 14 September 2026 from the supplied Danks & Strydom SEO strategy. This is a review branch, not a deployed release. No Google account, directory, production server or live mailbox was changed.

## Eight-service inventory update

Five requested offerings were added as distinct pages:

- `/services/joint-muscle-pain` — joint discomfort, muscular aches and movement difficulties.
- `/services/mobility-movement-assessment` — limitations in movement and everyday activities.
- `/services/chronic-pain-management` — persistent pain and everyday function, without a cure promise.
- `/services/injury-prevention` — movement/activity demands and reducing risk, without guaranteed prevention.
- `/services/rehabilitation-exercise-programmes` — individual exercise guidance, progression and review.

All eight service pages are now `published=true` following the user’s publication instruction. Public and authenticated preview hubs show eight linked cards. The empty-services fallback remains available if all services are later unpublished. Sitemap entries continue to follow publication flags; staging remains noindex with an empty sitemap.

The supplied screenshot defines the card order/icons: sports/pulse, back-neck/spine, post-operative/recovery, joint/joint, mobility/mobility, chronic/chronic, prevention/shield, exercise/program. The restored card styles use four columns on desktop, two on tablet and one on mobile. Labels/icons live in the inventory; clinical wording was not copied blindly from screenshot captions. Existing typography, colour and image treatments are preserved.

Each new page has distinct metadata/H1, assessment-first wording, one-hour first appointment and patient-information form, individual guidance, follow-up and an enquiry action. Shared fees/payment/cancellation policies stay on patient information. Each new page has only two relevant related services, filtered through the same publication/preview gate. Main navigation is unchanged.

Validation: **87 PHP tests / 483 assertions**, **2 JavaScript tests**, Pint, PHPStan (512 MB), production build, shell syntax and diff checks passed. Tests cover every new route, public 404/preview exclusion, later publication and sitemap inclusion, canonical/meta output, unique eight-page titles/descriptions, ordered card destinations/icons and filtered related links. Browser checks at **390px and 1440px** followed all eight card destinations, verified the five new layouts, one H1 each, no overflow or broken loaded images, two related links per new page, and one/four hub columns respectively. The desktop card design was compared with the supplied screenshot. A temporary loopback QA transport mismatch was corrected before destination checks; application HTTPS authentication is unchanged. Frontend assets rebuilt. No merge, deployment or live enquiries.

## Original visual design restoration

Backup branch: `backup/seo-before-layout-restoration-2026-09-14`, at `739e4dabc2f0a7ca891162ad3f867efb6fd1051c`. The active SEO branch remains `feature/local-seo-patient-journey` and this updates PR #4.

Visual reference: pre-SEO commit `42880b2`. Its section diffs were inspected and its homepage rendered in an isolated local checkout. The supplied original screenshot files were not available among this session’s attachments; this pass compares against the Git-rendered reference, not those specific screenshots.

- Restored the original hero architecture: Fraunces/Instrument Sans typography, original pine/sea/sand/bone colours, image crop, arch/backdrop, floating cards, chips and three-column fact strip. Confirmed appointment length/practitioner/service counts replace unsupported statistics.
- Restored the arched About illustration, offset sand card, split copy, dark numbered section and photo composition. All replacement copy uses confirmed facts, with no old experience, technique, outcome or quality guarantees.
- Reinstated the original seven-part homepage flow: hero → services → About → dark visit details → staggered practical cards → location → contact. The staggered composition replaces testimonials with practical facts; no reviews, stars or patient quotations are restored.
- Services retain the original card styling and gradient section. Approved/review-visible services become cards automatically; public empty services keep a direct enquiry action. A desktop illustration strip replaces the withheld mixed human/equine gallery using existing treatment illustrations, not claimed practitioner portraits.
- Restored the split dark-details/map location panel and the original contact-section washes, spacing and numbered introduction. Current configured address, verified directions/map gate, hours and enquiry component remain in use.
- Internal pages extend the original arch imagery, split introductions, dark surfaces and numbered content layouts. Removed the unrelated repeated link list; kept only a relevant service-to-patient-information link and a concise gated footer navigation.
- No colour rebranding was applied. Source colour/font definitions, JavaScript, routes, metadata/layout schema, canonical/discovery controls, authentication, enquiry mail/cache protections and deployment preflight were not replaced.

Validation: **80 PHP tests / 378 assertions**, **2 JavaScript tests**, Pint, PHPStan (512 MB), production asset build, shell syntax and diff checks passed. Production assets rebuilt. Browser checks at 390px and 1440px covered the homepage and all seven internal pages in authenticated review: one H1 each, no horizontal overflow, no broken loaded images and no redundant related-link lists. Public services fallback and mobile menu open/Escape close were also checked. Original/restored hero compositions were visually compared at desktop/mobile widths; the internal service layout was inspected on mobile. Existing tests continue to verify production draft exclusion and location gating. No live mail, production changes, merge or deployment.

## Current content review — supersedes earlier placeholder versions

The latest user-supplied answers replace earlier conflicting address and policy information. The user has waived Cheryl’s review and authorised publication of the completed service descriptions, short biographies and patient policies. Optional missing facts remain empty and hidden publicly; there are no public approval badges.

### Implemented content

- Full address: **Suite 102, Surgiklin Studios, Unit 12, Glen Eagle Office Park, Koorsboom Avenue, Glen Marais, Kempton Park, 1619, Gauteng, South Africa**. Display and split schema fields share this information; no active Monument Road references remain.
- Phone **011 391 3126**, public email/intended enquiry inbox **admin@danksandstrydom.co.za**. Actual mail recipients remain explicitly environment-configured; no live mail was sent.
- Gate access button, left passage to the end, parking/covered parking, ramp and elevator access use the supplied facts. No gate code or blanket wheelchair-accessibility claim was added.
- Hours: Monday–Friday 07:30–17:30; Saturday by appointment; Sundays/public holidays closed. Hours are displayed as text; no fixed Saturday hours are invented in schema.
- One-hour appointments, new-patient form, assessment before appropriate treatment and nothing to bring. Post-operative copy preserves the discussion of surgical instructions/restrictions.
- Completed booking/confirmation, direct-booking/referral, follow-up, fees/payment, interim medical-aid and cancellation wording uses the supplied text. The cancellation wording retains “may”; direct claim handling is not asserted.
- Text-only profiles use “Physiotherapist” and the supplied biographies. Only the already confirmed generic physiotherapy degrees are mentioned. Cheryl’s equine experience is biographical; no equine service or booking option was created.

### Map inspection

The approved directions link https://maps.app.goo.gl/WoxWSjSzNbtEkTr66 was resolved and inspected in Google Maps. It opens **Danks And Strydom**, with the matching public phone and Surgiklin Studios address. The embed source was obtained from that listing’s **Share → Embed a map** field; the short share URL is used only for directions. The supplied pin’s feature ID is `0x1e9515b5389c59e3:0xc9913cffe2473c26`. No coordinates were guessed or old map reused.

The location verification gate remains available and now defaults true for the supplied address and inspected map. Existing environment overrides still win. Google’s listing currently uses an older address format and showed a 17:00 closing time; the website uses the user’s confirmed address and 17:30 weekday closing time. Valourite should reconcile the listing once account access is established. No Google-account edits were made.

### Publication and private preview

- `/`, `/services`, `/contact`, `/about`, all eight service pages and `/patient-information` are enabled for public production visitors. The indexable production sitemap contains all 13 URLs.
- Contact’s booking-policy information is now in normal `sections`. Unknown optional practitioner and policy fields show missing-information labels only in authenticated staging; neither the labels nor optional profile fields enter metadata/schema.
- Staging review requires `APP_ENV=staging`, `SITE_REVIEW_PREVIEW=true`, a nonempty `SITE_REVIEW_USERNAME` and `SITE_REVIEW_PASSWORD_HASH` (PHP `password_hash` output), and HTTPS. Configure credentials privately; quote the hash in dotenv to preserve its dollar signs. Do not place credentials in query strings or share URLs.
- Every Laravel request in enabled staging review requires Basic authentication, including Livewire updates. Missing settings or insecure transport fail closed; invalid credentials are rejected and rate-limited. Responses are private/no-store and noindex. Production ignores preview credentials/flags and cannot reveal drafts through them.
- `Site::pages()` requires both staging configuration and a middleware-authenticated request attribute before including drafts. There is no query-string bypass. Keep staging indexing/canonical flags false and mail on a safe local/log transport.
- Valourite must provision the actual HTTPS staging host and pass Authorization headers through correctly. Protect static files/server paths too, exclude caches/CDNs from review responses, and never serve repository/configuration files. Only loopback staging-mode QA was run here; no hosted preview was deployed. Its temporary router simulated TLS solely for loopback layout QA; production code still requires HTTPS.
- Cheryl’s approval step is waived by the user. Missing optional content does not block publication; see `CONTENT-TODO.md` for exact keys and public destinations.

### Genuinely unresolved items

1. **Optional profile and policy details:** exact qualifications, universities, languages, longer biographies, portraits and further payment/medical-aid details are tracked in `CONTENT-TODO.md`. No Cheryl approval is required.
2. **Exact qualifications:** degree titles/universities remain unknown and are cleanly omitted. Do not infer registrations or McKenzie credentials.
3. **Medical-aid claim handling:** confirm direct submission and responsibility for rejected claims privately; the website currently directs patients to reception and their scheme.
4. **Photographs, when available:** obtain approved practitioner photos; the finished text layout works without them.
5. **Google-account access:** Valourite coordinates Business Profile/Search Console after ownership/access is established, including address/hours reconciliation.

The non-www HTTPS origin is confirmed as `https://danksandstrydom.co.za`. Valourite owns hosting and production configuration; these are remaining operational steps, not unanswered business-fact questions. Existing `.env` values (including blanks/stale contact fields) override new defaults; `.env.example` never changes production automatically.

### Actual validation

- **80 PHP tests / 378 assertions passed**, including prior deployment/email/replay checks and new authenticated staging, invalid credentials/hash, HTTPS requirement, rate limiting, production 404/navigation/sitemap gating, and draft wording checks.
- **2 JavaScript tests passed**; Pint, PHPStan (512 MB), production Vite build, shell syntax and diff checks passed. Rebuilt production assets are committed.
- Browser checks at **390px and 1440px** covered About, services, three service detail pages, patient information and Contact in authenticated loopback staging: all correct headings, no horizontal overflow or placeholders, and three preview cards. About’s text layout was visually inspected at desktop and mobile widths. Initial QA asset URL configuration was corrected before checking layouts.
- Tests use fake/mocked mail; local review uses log mail with a synthetic recipient. No merge, deployment, production configuration change, live enquiry or Google-account change occurred.

### Retained technical fixes

Production preflight validates a private candidate using the existing server environment before maintenance/reset/assets, then validates the rebuilt cached configuration. Mail success is recorded before cache bookkeeping; bookkeeping failures cannot falsely report sending failure. Both fixes and their meaningful tests remain intact.

### Preflight operation and limits

`php preflight.php /absolute/path/to/.env` validates fresh candidate configuration without booting application providers or contacting mail/database services. Existing inherited process environment values retain Laravel precedence. The fresh mode deliberately bypasses even an inherited `APP_CONFIG_CACHE` path; a stale valid active cache cannot conceal invalid release settings, and a stale invalid cache cannot reject corrected fresh settings. An explicitly present `.env.production` causes the deployment script to stop for operator review, rather than silently validate one file and later load another. No configuration is overwritten automatically.

The script checks that `.env` did not change during candidate validation, activates the exact validated SHA, then runs the established cache rebuild. `php preflight.php /absolute/path/to/.env --cached` checks the rebuilt effective configuration before bringing the site online. If anything after maintenance starts fails, maintenance remains enabled for operator recovery; the script no longer exposes a partially completed release via an unconditional `artisan up` trap. The deployment tests use temporary fixtures and stub external executables, not the production server.

This remains an **in-place deployment**, not an atomic release switch. Code reset, active dependency installation, assets and migrations can still fail after preflight; there is no automatic code/data rollback. Keep backups and restore matching code/assets/configuration before manually bringing the site up. Preflight does not prove SMTP inbox delivery, database readiness, clinical approval, Google indexing or Apache configuration. The host must ensure CLI and PHP-FPM use the same environment/cache paths and avoid concurrent configuration edits. Hard process termination can leave a private candidate directory requiring cleanup; ordinary success/error/signal exits remove it.

For the first upgrade, an operator must invoke the reviewed version of `deploy.sh` from a trusted separate path: the old script already on the server cannot acquire these safeguards until updated. Do not first reset the live checkout just to obtain the guard. Environment overrides prefixed `DANKS_DEPLOY_` exist for isolated tests/host paths; they do not bypass validation. Candidate preparation needs temporary disk space and Composer network/cache access. No production execution occurred in this task.

### Cache-based enquiry limits

Success means the synchronous mail transport returned successfully, not that the recipient read or even received the message. The component retains `sent=true` and clears personal fields even when bookkeeping fails. The normal accepted-ID cache lasts 24 hours and the lock 120 seconds; browser deduplication is per page lifetime. Cache loss/write failure, expired entries/locks, a process crash or lost response after transport acceptance, concurrent retries and a new component/session can still permit duplicate mail. This is not guaranteed exactly-once delivery. Do not encourage a patient to resubmit solely because the post-send cache write failed; monitor the generic bookkeeping warning separately from transport errors.

## What is ready

Laravel 13.15.0, Livewire 4.3.1, Tailwind 4.3.0 and Vite 8.0.16 remain in place. Dependencies and architecture were retained. Production assets are committed because the current deployment copies built assets and does not run npm.

- Homepage local metadata/H1, navigation to about/contact/services, existing hero/services/about/benefits/location/contact anchors, reusable page and service-card templates.
- Per-page metadata, canonical and social URL consistency based on this environment's `APP_URL`. Stable MedicalClinic entity with Physiotherapy as its medical specialty; no reviews, FAQ markup, guessed coordinates or fixed opening hours.
- Environment-aware robots and sitemap endpoints. Only published pages appear in production discovery; development/staging are noindex. Unknown and unpublished paths return 404, including with `?preview=true`.
- Synchronous form delivery retained, with validation, honeypot, five attempts per IP per ten minutes, a short-lived atomic submission lock and a 24-hour accepted-ID cache to prevent replay. Error logs omit transport exception messages that could contain patient data. UI distinguishes requests from confirmed appointments.
- Disabled-by-default analytics adapter emits only generic accepted-enquiry, phone-click and directions-click events. No vendor, tracking ID, page URL, referrer, patient details or clinical selections are transmitted. Acceptance IDs remain in the local adapter for deduplication and are not passed to a provider.
- Unsupported testimonials, experience/quality counters, referral promises, response-time promises and ambiguous mixed human/equine gallery are omitted. Gallery image assets are retained.

## Page inventory and release checklist

`config/site.php` contains complete page text and publication flags; `config/contact.php` contains centrally managed contact/location defaults. Draft routes/templates have no public preview query bypass. The current publication status and private preview procedure above supersede earlier versions of this PR that displayed placeholders publicly.

Before release, Valourite should:

- Confirm the intended published inventory and complete operational release checks. Optional content and Cheryl approval do not block publication.
- Review effective display/split address, verified map/entrance, phone/email and explicit enquiry recipient configuration against the supplied facts.
- Verify the existing server environment/cache has `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://danksandstrydom.co.za`, `SITE_INDEXABLE=true`, `SITE_CANONICAL_REDIRECTS=true`, and review preview disabled. Safe staging/local indexing defaults stay false.
- Use the candidate preflight and cached postflight, backups and host checks described below. No deployment is authorised by this PR update.
- Coordinate Google listing/Search Console setup through Valourite after ownership and access are established. Do not invent reviews, extra locations, treatment credentials or recovery promises.

## Material differences from the public audit

The repository contains configurable contact values rather than an authoritative business record. Its original defaults were placeholders, and its original example map environment line was malformed. Confirmed contact defaults and the inspected map now replace them. The deployed values are not available here. The no-queue synchronous mail implementation already had validation, failure handling and success-state behaviour: these were preserved. Spam controls and analytics were absent in inspected source. The deploy script copied static discovery files into `public_html`; merely deleting repo files would have broken deployment and left stale hosting files, so the script now removes those two obsolete public files. Missing Request/Process imports in the existing deploy route were corrected; that endpoint was never invoked.

The old whole-address schema, Physiotherapy node type, relative-only menu, non-link service CTA, counters and unsupported policy claims matched the reported concerns. The old desktop carousel includes human and equine images. No historical URL rankings, selected Google canonical, exact Google rank, real mail delivery, consent records or practitioner verification can be inferred from code. The old testimonials anchor is intentionally no longer promoted because its section is withheld.

Schema vocabulary was checked against https://schema.org/MedicalClinic and https://schema.org/Physiotherapy. Automated tests parse JSON-LD and check type/identity/fields; this is not a claim that Google's Rich Results Test or Schema.org's hosted validator was run. Those release checks remain external.

## Verification

See the accompanying test results, browser-check JSON and screenshots. Tests use fake mail; the browser uses local `MAIL_MAILER=log` with synthetic `.test` data. No production delivery is claimed. Existing tests were updated where the intended public behaviour changed (gallery withholding, new metadata and booking wording), while asset checks remain. The initial test setup needed a local app key; after configuration the existing suite passed. Default PHPStan hit this machine's 128 MB limit; rerunning with `--memory-limit=512M` passed.

`npm ci` initially reported four dependency audit findings (two high, two critical). No lockfile/package versions were changed; follow up with a supported-Node `npm audit` and a separately reviewed dependency update. Do not run `npm audit fix --force` as part of this content release.

## Hosting and release instructions (prepared, not applied)

1. The user has authorised the current published inventory and waived Cheryl’s approval. Obtain separate merge/deployment authorisation; the preferred non-www HTTPS hostname is confirmed.
2. Back up the current code revision, `public_html` (including `.htaccess`, index.php and discovery files), `.env`, database and any uploaded media. Record the old SHA and keep a restoration copy off the public document root. This branch has no database migrations.
3. Review on a private staging origin with `APP_ENV=staging`, `APP_URL` set to that staging origin, `SITE_INDEXABLE=false`, `SITE_CANONICAL_REDIRECTS=false`, analytics disabled and safe mail. Use server authentication/network controls: robots/noindex are not confidentiality controls.
4. Use the locked dependencies with PHP compatible with this Laravel 13 lockfile and Node supported by Vite 8 (local build used bundled Node). Run `composer install`, `npm ci`, `npm run build`, `vendor/bin/pint --dirty --format agent`, `vendor/bin/phpstan analyse --memory-limit=512M`, `php artisan test --compact`, `node --test tests/analytics.test.js` and `bash -n deploy.sh`. Confirm tracked `public/build` matches source.
5. Populate the approved `CONTACT_*` values in the environment. Supply full display address AND split fields from the same approved fact sheet. Review the supplied verified map/address and preserve the verification gate; set the effective flag to true for the approved configuration. Map values must be URLs, never pasted iframe HTML. Confirm SMTP configuration/timeout, actual recipients, writable shared cache and sessions. Synchronous mail is intentionally retained because the host has no queue worker. Monitor generic mail failures and practice reception outcomes; acceptance does not prove inbox receipt.
6. For approved production, set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://danksandstrydom.co.za`, `SITE_INDEXABLE=true` and `SITE_CANONICAL_REDIRECTS=true`. **These indexing flags default to false: omitting this step will keep production noindex.** Leave analytics false until its provider and privacy handling are settled.
7. The prepared `deploy.sh` still targets `main` and resets its checkout. Do not execute it from this feature branch expecting a preview. After separate merge/deployment authorisation, use the established release process. Its new removal of `public_html/robots.txt` and `public_html/sitemap.xml` allows the Laravel routes to answer through the existing front controller. Verify cPanel document-root/index.php paths; they are outside this checkout. The script validates a private candidate first and does not automatically roll back code on failure; see the review follow-up above for the first-upgrade procedure.
8. `APP_URL` drives SEO output. Application redirects cover known production aliases on GET/HEAD only; they do not redirect local/staging hosts or form POSTs. For direct Apache TLS termination, add the following **production virtual-host-only** rules before the existing Laravel rewrite rules to cover static files too. Keep staging in a different vhost. If TLS terminates at a proxy, have the host configure trusted proxy handling first; do not blindly trust arbitrary forwarded headers.

```apache
# Only install in the production virtual host after confirming the preferred host.
RewriteEngine On
# Collapse a non-directory trailing slash and canonical host in one response.
RewriteCond %{REQUEST_METHOD} ^(GET|HEAD)$
RewriteCond %{HTTP_HOST} ^(www\.)?danksandstrydom\.co\.za$ [NC]
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/$ https://danksandstrydom.co.za/$1 [R=301,L,NE]

RewriteCond %{REQUEST_METHOD} ^(GET|HEAD)$
RewriteCond %{HTTP_HOST} ^(www\.)?danksandstrydom\.co\.za$ [NC]
RewriteCond %{HTTPS} !=on [OR]
RewriteCond %{HTTP_HOST} ^www\.danksandstrydom\.co\.za$ [NC]
RewriteRule ^ https://danksandstrydom.co.za%{REQUEST_URI} [R=301,L,NE]
```

These rules preserve query strings implicitly. Test direct HTTPS, HTTP, www, nested paths, trailing slashes, encoded paths and query strings with `curl -I` and verify one-hop destinations/no loops. Server-specific virtual-host placement should be verified by the host; application tests do not execute Apache.

9. Clear/rebuild config, routes and views after environment changes. Test homepage/about/contact/services, all eight service URLs and Patient Information, robots, sitemap, nonexistent URL 404, map/address agreement, phone link and mobile menu. Check Schema.org Validator and Google's applicable structured-data tools. Perform one explicitly authorised live delivery test and verify reception receipt. No such test was performed here.
10. Analytics setup: after provider/consent approval, connect a reviewed listener to `site:analytics`. Consume only `event.detail.event`; never enrich it with form state, URLs, referrers, query strings or clinical selections. `SITE_ANALYTICS_ENABLED=true` enables local event dispatch only; it does not install GA/GTM or make network requests. Disable automatic form capture/enhanced measurement where it could collect data. Test one accepted enquiry event and contact clicks with the provider's debugger.

## Rollback

Restore the recorded prior code SHA and matching built assets, public files and environment backup. Restore old discovery files if returning to the old static implementation. Clear/rebuild Laravel caches and confirm site availability, forms and canonical/robots behaviour. Do not run migration rollback blindly; this change adds no migrations. If deployment fails after maintenance starts, the revised shell trap keeps maintenance enabled: it does not restore the previous release. Restore or complete the release and explicitly bring it up only after verification. Keep the previous deployment available until post-release checks pass.

## Separate Google and directory checklist

- [ ] Practice owns Search Console and Google Business Profile; grant appropriate management access, no duplicate profiles.
- [ ] Export available historical Search Console/profile data; record launch date. If absent, establish a prospective baseline.
- [ ] Verify domain property, indexing/security/manual-action status, submit approved sitemap and inspect homepage/new URLs and selected canonicals.
- [ ] Confirm profile name/categories, address/pin, phone, hours/holidays, services and appointment-request URL; approve real photos and any practitioner profiles.
- [ ] Confirm whether Serengeti or another real location exists before creating a page/profile.
- [ ] Correct Snupit location/category, Think Local former-location details, Medpages address, SAVET scope and McKenzie directory entries only against approved facts. Keep URL/field/replacement/requester/date/result register.
- [ ] Set an appropriate healthcare review/publication policy before any review requests; no automated review campaign has been added.
- [ ] Record local search observations by query, date, device and location; separate organic and Maps. No rank/volume claim is made here.
- [ ] Review comparable 28-day and rolling 90-day Search Console periods, non-brand queries, landing pages and device performance. Reception tracks qualified enquiries and confirmed appointments in its own system; report aggregates, not clinical data to analytics.
- [ ] Obtain PageSpeed Insights/mobile/desktop and field data where available. Local synthetic timings are not real-user Core Web Vitals or ranking evidence.

## Original implementation results (before this review follow-up)

- 36 PHP tests passed, 161 assertions; 2 JavaScript tests passed.
- Pint passed; PHPStan passed with 512 MB limit; production Vite build passed; route/config cache and `bash -n deploy.sh` passed.
- Chromium checked homepage, about, services and contact at 390px and 1440px: HTTP 200, one H1, no horizontal overflow, no uncaught JavaScript errors. Mobile menu open/Escape close and form validation checked. Local log-only accepted enquiry rendered successfully. Repeated browser QA initially reached the intended rate limit; the local cache was cleared before the final run.
- One unthrottled local Chromium run: mobile LCP 536 ms, CLS 0.000451; desktop LCP 636 ms, CLS 0.001085. Navigation DOMContentLoaded was 483 ms / 571 ms; resource transfers about 978 KB / 1,000 KB. Ten font preloads remain. These are local engineering observations, not Lighthouse scores, field Core Web Vitals, comparative gains or ranking forecasts. INP was not measured.

Base revision: `42880b2892d4c22944b64dc0e5ba9e7b75b356bb` on `main`.
Branch: `feature/local-seo-patient-journey`.
