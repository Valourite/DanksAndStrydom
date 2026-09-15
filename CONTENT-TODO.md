# Optional content to complete

All eight service pages, About and Patient Information are enabled for public release. Contact's booking information is public content. The user waived Cheryl's approval step; none of the optional items below blocks publication. This branch has not been merged or deployed.

Unknown values are `null` or empty arrays in `config/site.php`. Keep them empty until real information is supplied. Public pages omit incomplete fields; only authenticated staging preview displays “Missing optional information” labels. These fields and labels are not used in metadata or structured data. Photographs require both an approved asset path (relative to `public/`) and descriptive alt text. Do not use stock people as practitioner portraits.

## Practitioner information

All keys below are in **`config/site.php`**. `site.pages.about.practitioners.0` is **Cheryl Myburgh**; `site.pages.about.practitioners.1` is **Elize Strydom**. Keep this order when editing the numeric entries.

| Done | Person / missing item | Configuration key | What to supply / where it appears |
|---|---|---|---|
| [ ] | Cheryl: exact qualifications | `site.pages.about.practitioners.0.qualifications` | List of exact degree/qualification titles, without inferred specialist credentials; About profile below the short biography. |
| [ ] | Cheryl: universities | `site.pages.about.practitioners.0.universities` | List of awarding universities; About profile. |
| [ ] | Cheryl: longer biography | `site.pages.about.practitioners.0.expanded_biography` | Optional factual expansion of the existing short biography; About profile. Do not invent years, employment history or clinical interests. |
| [ ] | Cheryl: languages | `site.pages.about.practitioners.0.languages` | List of languages offered in consultations; About profile. |
| [ ] | Cheryl: approved photograph | `site.pages.about.practitioners.0.photo.path` and `.photo.alt` | Approved image asset and accurate alternative text; About profile. Both must be filled before an image appears. |
| [ ] | Elize: exact qualifications | `site.pages.about.practitioners.1.qualifications` | List of exact degree/qualification titles; About profile below the short biography. |
| [ ] | Elize: universities | `site.pages.about.practitioners.1.universities` | List of awarding universities; About profile. |
| [ ] | Elize: longer biography | `site.pages.about.practitioners.1.expanded_biography` | Optional factual expansion; About profile. Existing short biography is already recorded. |
| [ ] | Elize: languages | `site.pages.about.practitioners.1.languages` | List of languages offered in consultations; About profile. |
| [ ] | Elize: approved photograph | `site.pages.about.practitioners.1.photo.path` and `.photo.alt` | Approved image asset and accurate alternative text; About profile. Both must be filled before an image appears. |

## Other optional practice information

All keys below are also in **`config/site.php`**. Populating a `body` adds its labelled section to Patient Information. Keep the existing confirmed sections consistent if adding more detail.

| Done | Missing item | Configuration key | What to supply / where it appears |
|---|---|---|---|
| [ ] | Consultation fee amounts | `site.pages.patient-information.optional_sections.consultation_fees.body` | Current amounts and currency, only if you want prices displayed. Patient Information: Current consultation fees. The existing “contact the practice” wording is usable without prices. |
| [ ] | Payment timing | `site.pages.patient-information.optional_sections.payment_timing.body` | When payment is due. Patient Information: When payment is due. Cash/card acceptance is already confirmed. |
| [ ] | Medical-aid submission process | `site.pages.patient-information.optional_sections.medical_aid_claims.body` | Whether the practice submits claims, whether patients pay first, and the actual process; no assumptions about scheme coverage. Patient Information: Submitting medical-aid claims. |
| [ ] | Declined claims | `site.pages.patient-information.optional_sections.declined_claims.body` | Who is responsible and what happens if a claim is declined. Patient Information: Declined medical-aid claims. |
| [ ] | Separate missed-appointment policy | `site.pages.patient-information.optional_sections.missed_appointments.body` | A no-show policy, if there is one. Patient Information: Missed appointments. Do not infer this from the confirmed cancellation policy. |

## Confirmed information already recorded

Do not treat these as missing or replace them with placeholders:

- **Names, professional title and short biographies:** `config/site.php`, `site.pages.about.practitioners.{0,1}.name`, `.title`, `.biography`. Both hold physiotherapy degrees; exact degree titles/universities remain unknown. Cheryl's supplied human/equine experience is biographical and does not create an equine service offering at these rooms.
- **Eight service offerings and patient-facing descriptions:** `config/site.php`, `site.pages.<service-name>`. All eight are now published in configuration.
- **One-hour appointments, patient-information form, assessment-first approach, nothing to bring, booking/confirmation, referrals and follow-up:** `config/site.php`, `site.pages.patient-information.sections` and `site.pages.contact.sections`.
- **Cash/card acceptance and cancellation wording:** `site.pages.patient-information.sections`. At least 24 hours' notice; with less notice the patient may be liable for the full appointment fee. Do not turn “may” into an automatic charge.
- **Address, arrival, parking/access, hours, telephone, public email and verified map/directions:** `config/contact.php`, `contact.practice.*`. Suite 102, Surgiklin Studios, Unit 12, Glen Eagle Office Park, Koorsboom Avenue, Glen Marais, Kempton Park, 1619; phone 011 391 3126; email admin@danksandstrydom.co.za.
- **Intended enquiry inbox:** admin@danksandstrydom.co.za, recorded in `.env.example`. The actual recipient list is read by `config/contact.php`, `contact.recipients`, from the server's `CONTACT_MAIL_TO`; verifying it is an operational task, not an unknown business fact.

## External release tasks, not missing website content

- Valourite must verify existing production environment overrides, mail delivery configuration, recipients, location fields and effective cached configuration. Production preflight must pass before deployment; safe indexing defaults remain false.
- Merge and deployment still require separate authorisation. Publishing configuration here does not change the live site.
- Establish Google Business Profile/Search Console ownership and access through Valourite, reconcile listing details and submit the indexable sitemap after release. No Google-account changes have been made.
