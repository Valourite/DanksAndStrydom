# Local SEO and enquiry implementation review

Prepared 14 September 2026 from the supplied Danks & Strydom SEO strategy. This is a review branch, not a deployed release. No Google account, directory, production server or live mailbox was changed.

## What is ready

Laravel 13.15.0, Livewire 4.3.1, Tailwind 4.3.0 and Vite 8.0.16 remain in place. Dependencies and architecture were retained. Production assets are committed because the current deployment copies built assets and does not run npm.

- Homepage local metadata/H1, navigation to about/contact/services, existing hero/services/about/benefits/location/contact anchors, reusable page and service-card templates.
- Per-page metadata, canonical and social URL consistency based on this environment's `APP_URL`. Stable MedicalClinic entity with Physiotherapy as its medical specialty; no reviews, FAQ markup, guessed coordinates or fixed opening hours.
- Environment-aware robots and sitemap endpoints. Only approved pages appear in production discovery; development/staging are noindex. Unknown and unpublished paths return 404, including with `?preview=true`.
- Synchronous form delivery retained, with validation, honeypot, five attempts per IP per ten minutes, a short-lived atomic submission lock and a 24-hour accepted-ID cache to prevent replay. Error logs omit transport exception messages that could contain patient data. UI distinguishes requests from confirmed appointments.
- Disabled-by-default analytics adapter emits only generic accepted-enquiry, phone-click and directions-click events. No vendor, tracking ID, page URL, referrer, patient details or clinical selections are transmitted. Acceptance IDs remain in the local adapter for deduplication and are not passed to a provider.
- Unsupported testimonials, experience/quality counters, referral promises, response-time promises and ambiguous mixed human/equine gallery are omitted. Gallery image assets are retained.

## Publication inventory

Paths follow the existing Apache convention without trailing slashes. No old content pages were found to replace or redirect. The homepage remains the broad Glen Marais / Kempton Park landing page.

| Path | Intent | Status | Reviewer |
|---|---|---|---|
| `/` | Local physiotherapy enquiry | Implemented; release review required | Practice + technical |
| `/about` | Practice identity and practitioner enquiries | Minimal factual introduction implemented; biographies pending | Cheryl/Elize |
| `/contact` | Enquiry and directions | Implemented; contact/location configuration required | Reception/practice |
| `/services` | Select next enquiry step | Implemented; approved service links appear automatically | Clinicians |
| `/services/back-neck-pain` | Back/neck pain enquiries | Unpublished draft, returns 404 | Clinician required |
| `/services/sports-injury-rehabilitation` | Sports rehabilitation enquiries | Unpublished draft, returns 404 | Clinician required |
| `/services/post-operative-rehabilitation` | After-surgery enquiries | Unpublished draft, returns 404 | Clinician required |
| `/patient-information` | First-visit policies | Unpublished question-led draft, returns 404 | Reception + clinician |
| McKenzie / Serengeti | Conditional future offering/location | No public route or content claim | Confirmation required |

`config/site.php` is the page inventory, including exact titles, descriptions, headings, draft copy and publication flags. Canonical is `APP_URL` plus the listed path. Content is rendered through one template. Publish a draft only in a reviewed code change after its copy is complete and approved; changing the flag alone is not clinical approval. New service cards, related links and sitemap entries then follow the same inventory. No HTTP preview bypass exists. Review draft source locally or render it on a genuinely access-controlled review environment. A public GitHub repository is not a place for confidential patient records or permissions evidence.

## Content verification required before release

Keep approval records privately, recording fact, source, approving person and approval date. Do not add patient information or consent evidence to this public repository.

1. **Location:** resolve 194 versus 196 Monument Road with the practice. Confirm street address, suburb/locality, municipality, province, postal code, entrance, actual map pin and directions URL. The repo's old map explicitly used 196; the PDF reports visible production text 194. Neither proves the entrance. New defaults are empty and map/address schema remain suppressed until `CONTACT_LOCATION_VERIFIED=true`. No guessed pin or coordinates were added.
2. **Contact:** confirm public telephone/email and actual mail recipients. The old repository defaults were a dummy phone, Cape Town address and a malformed embed value in `.env.example`; do not copy these into production. Existing deployment environment values must be reviewed and retained where correct. Telephone links appear only for a configured number.
3. **People:** confirm Cheryl Danks and Elize Strydom's current roles, qualifications, registration details suitable for publication, approved photographs and relevant experience. Obtain original bios. About page currently makes no individual credential claims.
4. **Services:** confirm each priority service, clinician, presentations/procedures supported, assessment and follow-up approach, information to bring, limitations/referral considerations and genuine patient questions. Current drafts are enquiry-oriented review scaffolds; they do not substitute for substantive clinician input. No specific treatment advice or recovery timeline has been invented.
5. **Patient policies:** obtain actual fees/payment/medical-aid, referral, cancellation, visit preparation and appointment-confirmation arrangements. No policy is inferred from the old website.
6. **Hours/arrival:** approve hours and holiday handling, parking and access facts. Hours have no invented default; no parking/access promise remains.
7. **McKenzie:** confirm active individual credentials and services directly; update old clinician-directory details if necessary. No practice-wide certification is claimed.
8. **Equine/Serengeti:** determine current human/equine scope and whether another patient-facing location genuinely operates. Withholding the gallery is a clarity/publication decision, not a finding that horse treatment was false.
9. **Testimonials/images:** testimonial text is present in initial sketch commit `1574a02`; subsequent history does not establish source, authenticity, permission or current publication suitability. All five stories and stars are omitted, without alleging fabrication. Obtain provenance, image permissions and appropriate professional publication review before restoring anything.
10. **Privacy:** approve actual handling/retention/access procedures and fuller privacy notice. Current form explains that details are emailed for handling the enquiry and discourages detailed clinical information; it makes no blanket non-sharing promise.

## PDF recommendation checklist

| Recommendation | Disposition |
|---|---|
| Retain Laravel/visual identity | Implemented; existing colours, typography, hero treatment image and components |
| Reconcile public audit with code | Completed; differences below |
| Broad local homepage + ordinary links | Implemented |
| Three useful service pages | Routes/templates/draft copy prepared; substantive clinical content and publication await confirmation |
| Practitioner biographies | About structure ready; facts/photos/bios await confirmation |
| Contact/arrival | Form and directions structure implemented; address/pin/contact facts await confirmation |
| Patient-information page | Unpublished draft pending actual policies |
| Canonical host/protocol | Application GET/HEAD redirect ready, production opt-in; static asset/Apache rule external setup |
| Titles, descriptions, headings, initial HTML | Implemented; tested |
| Correct schema/address fields | Implemented; unconfirmed location fields omitted |
| Sitemap/robots/404 | Implemented and tested; stale cPanel files removed by prepared deploy script |
| Reliable enquiries/no live unsolicited mail | Fake-mail tests and local log-only browser submission completed; authorised production delivery test still required |
| Conversion/contact tracking | Generic adapter + deduplication tested; provider/consent/configuration external setup |
| Mobile/accessibility/performance | Local browser checks/screenshots and measurements; field measurements still required |
| Google Business Profile/Search Console/directories | External checklist below; no account changes applied |
| McKenzie/extra locations/condition pages | Deferred until factual evidence and demand justify them |
| Paid links, bulk suburb pages, invented reviews/claims | Excluded |

## Material differences from the public audit

The repository contains configurable contact values rather than an authoritative business record. Its defaults are placeholders, and its example map environment line was malformed. The deployed values are not available here. The no-queue synchronous mail implementation already had validation, failure handling and success-state behaviour: these were preserved. Spam controls and analytics were absent in inspected source. The deploy script copied static discovery files into `public_html`; merely deleting repo files would have broken deployment and left stale hosting files, so the script now removes those two obsolete public files. Missing Request/Process imports in the existing deploy route were corrected; that endpoint was never invoked.

The old whole-address schema, Physiotherapy node type, relative-only menu, non-link service CTA, counters and unsupported policy claims matched the reported concerns. The old desktop carousel includes human and equine images. No historical URL rankings, selected Google canonical, exact Google rank, real mail delivery, consent records or practitioner verification can be inferred from code. The old testimonials anchor is intentionally no longer promoted because its section is withheld.

Schema vocabulary was checked against https://schema.org/MedicalClinic and https://schema.org/Physiotherapy. Automated tests parse JSON-LD and check type/identity/fields; this is not a claim that Google's Rich Results Test or Schema.org's hosted validator was run. Those release checks remain external.

## Verification

See the accompanying test results, browser-check JSON and screenshots. Tests use fake mail; the browser uses local `MAIL_MAILER=log` with synthetic `.test` data. No production delivery is claimed. Existing tests were updated where the intended public behaviour changed (gallery withholding, new metadata and booking wording), while asset checks remain. The initial test setup needed a local app key; after configuration the existing suite passed. Default PHPStan hit this machine's 128 MB limit; rerunning with `--memory-limit=512M` passed.

`npm ci` initially reported four dependency audit findings (two high, two critical). No lockfile/package versions were changed; follow up with a supported-Node `npm audit` and a separately reviewed dependency update. Do not run `npm audit fix --force` as part of this content release.

## Hosting and release instructions (prepared, not applied)

1. Obtain factual/clinical approval and complete the withheld pages where appropriate. Confirm the preferred hostname against available Search Console history before enabling consolidation.
2. Back up the current code revision, `public_html` (including `.htaccess`, index.php and discovery files), `.env`, database and any uploaded media. Record the old SHA and keep a restoration copy off the public document root. This branch has no database migrations.
3. Review on a private staging origin with `APP_ENV=staging`, `APP_URL` set to that staging origin, `SITE_INDEXABLE=false`, `SITE_CANONICAL_REDIRECTS=false`, analytics disabled and safe mail. Use server authentication/network controls: robots/noindex are not confidentiality controls.
4. Use the locked dependencies with PHP compatible with this Laravel 13 lockfile and Node supported by Vite 8 (local build used bundled Node). Run `composer install`, `npm ci`, `npm run build`, `vendor/bin/pint --dirty --format agent`, `vendor/bin/phpstan analyse --memory-limit=512M`, `php artisan test --compact`, `node --test tests/analytics.test.js` and `bash -n deploy.sh`. Confirm tracked `public/build` matches source.
5. Populate the approved `CONTACT_*` values in the environment. Supply full display address AND split fields from the same approved fact sheet. Set the verification flag only when the actual map/address agree. Map values must be URLs, never pasted iframe HTML. Confirm SMTP configuration/timeout, actual recipients, writable shared cache and sessions. Synchronous mail is intentionally retained because the host has no queue worker. Monitor generic mail failures and practice reception outcomes; acceptance does not prove inbox receipt.
6. For approved production, set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://danksandstrydom.co.za` (if confirmed preferred), `SITE_INDEXABLE=true` and `SITE_CANONICAL_REDIRECTS=true`. **These indexing flags default to false: omitting this step will keep production noindex.** Leave analytics false until its provider and privacy handling are settled.
7. The prepared `deploy.sh` still targets `main` and resets its checkout. Do not execute it from this feature branch expecting a preview. After separate merge/deployment authorisation, use the established release process. Its new removal of `public_html/robots.txt` and `public_html/sitemap.xml` allows the Laravel routes to answer through the existing front controller. Verify cPanel document-root/index.php paths; they are outside this checkout. The script does not automatically roll back code on failure.
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

9. Clear/rebuild config, routes and views after environment changes. Test homepage/about/contact/services, approved draft URLs, robots, sitemap, nonexistent URL 404, map/address agreement, phone link and mobile menu. Check Schema.org Validator and Google's applicable structured-data tools. Perform one explicitly authorised live delivery test and verify reception receipt. No such test was performed here.
10. Analytics setup: after provider/consent approval, connect a reviewed listener to `site:analytics`. Consume only `event.detail.event`; never enrich it with form state, URLs, referrers, query strings or clinical selections. `SITE_ANALYTICS_ENABLED=true` enables local event dispatch only; it does not install GA/GTM or make network requests. Disable automatic form capture/enhanced measurement where it could collect data. Test one accepted enquiry event and contact clicks with the provider's debugger.

## Rollback

Restore the recorded prior code SHA and matching built assets, public files and environment backup. Restore old discovery files if returning to the old static implementation. Clear/rebuild Laravel caches and confirm site availability, forms and canonical/robots behaviour. Do not run migration rollback blindly; this change adds no migrations. If the deployment fails, the existing shell trap only brings the app out of maintenance: it does not restore the previous release. Keep the previous deployment available until post-release checks pass.

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

## Recorded local results

- 36 PHP tests passed, 161 assertions; 2 JavaScript tests passed.
- Pint passed; PHPStan passed with 512 MB limit; production Vite build passed; route/config cache and `bash -n deploy.sh` passed.
- Chromium checked homepage, about, services and contact at 390px and 1440px: HTTP 200, one H1, no horizontal overflow, no uncaught JavaScript errors. Mobile menu open/Escape close and form validation checked. Local log-only accepted enquiry rendered successfully. Repeated browser QA initially reached the intended rate limit; the local cache was cleared before the final run.
- One unthrottled local Chromium run: mobile LCP 536 ms, CLS 0.000451; desktop LCP 636 ms, CLS 0.001085. Navigation DOMContentLoaded was 483 ms / 571 ms; resource transfers about 978 KB / 1,000 KB. Ten font preloads remain. These are local engineering observations, not Lighthouse scores, field Core Web Vitals, comparative gains or ranking forecasts. INP was not measured.

Base revision: `42880b2892d4c22944b64dc0e5ba9e7b75b356bb` on `main`.
Branch: `feature/local-seo-patient-journey`.
