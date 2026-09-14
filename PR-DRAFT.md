# Improve local SEO structure and appointment enquiries

The existing single-page site uses generic local metadata, a Physiotherapy schema type and service CTAs without destinations. This PR adds reusable about/contact/services pages, gated service/patient-information drafts, consistent metadata and MedicalClinic identity, environment-aware discovery and a safer synchronous enquiry journey while retaining Laravel/Livewire and the current visual design.

## Review findings addressed

- **Production preflight:** validates the isolated candidate against a private copy of the server's existing `.env` before maintenance, active reset/Composer or asset removal. Checks production/debug/origin/indexing settings and required contact/location configuration; reports keys only. Bypasses stale active caches for fresh validation, then verifies the rebuilt effective cache before bringing the site online. Failed post-activation work retains maintenance for recovery.
- **Services:** replaces the empty grid with a direct appointment-enquiry action; removes the Explore self-link on `/services`; approved service links appear automatically. Draft structure is improved, without publishing unapproved clinical or policy content.
- **Enquiries:** successful synchronous mail sets success and dispatches the generic acceptance event before cache bookkeeping. Bookkeeping/lock-release failures are logged without personal information and cannot report mail failure. Genuine mail failures and normal replay protection remain covered. Cache-based deduplication does not guarantee exactly-once delivery.
- **Release readiness:** `SEO-REVIEW.md` separates code changes, practice confirmation and production/Google-account tasks, including the 194/196 address discrepancy, map/entrance, public contact/internal recipients, clinician/service approval and indexing configuration.

## Validation

73 PHP tests / 271 assertions and 2 JavaScript tests passed. Pint, PHPStan with 512 MB, production Vite build, shell syntax and diff checks passed. Rebuilt production assets are included. Local Chromium empty/published-service fixtures passed at 390px and 1440px with correct cards/actions, no redundant Explore link, overflow or uncaught JS errors. Mail testing was fake/mocked only.

## Remaining release requirements

The three priority service pages and patient-information page remain unpublished (404; absent from navigation/sitemaps). Obtain the specific clinical/policy/practitioner answers and approved address/map/contact facts listed in `SEO-REVIEW.md`. Confirm the intended non-www production origin and configure the required flags through the deployment operator. Preflight checks presence/syntax, not clinical truth, SMTP inbox delivery or Google indexing.

The current deploy process remains in-place and needs backups/manual recovery; preflight does not make it an atomic deployment. For the first upgrade, invoke the reviewed deployment script separately rather than changing the active checkout to obtain it. The server's old script does not yet contain the guard. Production Apache/proxy/cache-path checks, authorised live delivery verification and Google-account tasks remain external. The existing dependency-audit follow-up is unchanged.

Draft review only: do not merge or deploy without separate authorisation. No production configuration, live enquiry or Google-account changes were made.
