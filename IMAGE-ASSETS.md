# Website image collection

Generated on 18 September 2026 with the built-in OpenAI image-generation tool (`image_gen.imagegen`). These fictional scenes illustrate physiotherapy; they are not photographs of Cheryl, Elize, actual patients or the practice. They do not confirm particular equipment or techniques at the practice. Practitioner portrait fields in `config/site.php` remain separate and unchanged.

## Audit and selection

Before this change, `back_strapping.webp` appeared in the homepage hero, image strip, back/neck hero and every page's social metadata. `knee_strapping.webp` appeared in the first-visit panel, strip, sports and post-operative heroes. `valf_physio.webp` appeared in the About arch, questions card, strip and the remaining nine internal-page heroes. The same three files therefore covered seven homepage slots and twelve internal pages. Dormant human/equine gallery files were not displayed.

The original images remain in Git/public/images for review, but are no longer used by the public layouts. Close-up taping/manual-treatment imagery was replaced with a coherent assessment/exercise collection matching the requested style and avoiding assumptions about specific practice techniques. No stock downloads, portraits or brand assets were substituted.

## Final files and usage

All variants are under `public/images/illustrations/`. Each scene has `-480.webp` (480×360), `-768.webp` (768×576) and `-1200.webp` (1200×900). The filenames below are the large/social variants; smaller variants use the same stem.

| File | Placement | Selected generated source |
| --- | --- | --- |
| `consultation-1200.webp` | Homepage hero; Contact; Chronic Pain Management | `exec-2030c678-a6d9-4cbf-86ed-232686d549ec.png` |
| `neck-1200.webp` | Homepage first-visit panel; Back & Neck Pain; Patient Information | `exec-ce68b720-5c03-4910-9be6-5fd30464608f.png` |
| `sports-1200.webp` | Homepage image strip; Sports Injury Rehabilitation; Injury Prevention | `exec-63a87707-c7ad-4747-ac88-6a5d4eb68624.png` |
| `knee-1200.webp` | Homepage image strip; Post-Operative Rehabilitation | `exec-4183676f-2e6a-4e3b-815f-aea7fd487d3a.png` |
| `shoulder-1200.webp` | Homepage About illustration; About; Joint & Muscle Pain | `exec-d1809fd2-7b35-42ef-84c6-fd0963b32bf2.png` |
| `mobility-1200.webp` | Homepage image strip; Services hub; Mobility & Movement Assessment | `exec-ff63dd98-073f-498b-b72a-ece22e8310df.png` |
| `exercise-1200.webp` | Homepage questions card; Rehabilitation Exercise Programmes | `exec-3dfd177b-c8ad-4c98-ad7b-95dd36b4b7fb.png` |

## Delivery and editing

- Edit asset paths, alt text, dimensions and width variants in `config/imagery.php` (`imagery.images.<scene>`); page selection is `imagery.pages`, keyed by existing URL. Homepage selections live in the existing section templates through `<x-site.image>`.
- The shared image component emits native `srcset`, `sizes`, intrinsic dimensions and lazy loading. Only the main hero on each page is eager/high priority. The homepage responsive preload matches its hero exactly. Below-fold images retain their existing containers/reveal effects; the three-image strip remains hidden on mobile.
- WebP quality 78, method 6, Lanczos resizing. Original generations are 1448×1086, also 4:3. No content was retouched in the optimisation step. The 21 variants total 727,736 bytes; each large file is 43–66 KB. All seven 480px variants total 111,106 bytes, compared with 224,826 bytes for the previous three source files. Higher-density screens can request larger variants; this is an asset-size comparison, not a measured whole-page performance score.
- Social metadata uses each page's selected 1200×900 image and accurate illustrative alt text. Removed the generated photo from `MedicalClinic.image` to avoid identifying fictional people/premises as the real clinic; the clinic identity, contact/address data and other SEO controls remain intact.
- Captions and a short footer disclosure identify the images as illustrations. Do not populate practitioner portraits from this collection.
- Existing deployment recursively copies `public/images`, including this directory. The deployment test now verifies nested assets survive rejected preflight and are copied after accepted preflight. No deployment was run.

## Generation prompt record

Each initial image was generated separately. The consultation prompt was:

> Use case: photorealistic-natural. Create one editorial photograph for a physiotherapy website, landscape 4:3. A welcoming consultation: a Black South African adult woman patient in modest casual clothing and a female physiotherapist in plain muted blue scrubs sit facing each other at a slight angle, calmly listening, relaxed hands resting separately on their own laps. Natural daylight, warm off-white walls, light oak, a simple uncluttered neutral clinical interior with subtle blue accents. Waist-up with both faces near the central area, ample headroom and space at the sides so an arched container can crop edges safely. Candid professional photography, realistic skin texture and proportions, gentle warm colour grading, no dramatic expressions. Fictional illustrative people and setting, not actual practitioners or a real clinic. No text, logos, badges, watermarks, additional people or specialised equipment. Anatomically correct hands, limbs and faces; simple pose, no touching or overlapping hands.

The other six prompts were:

### neck

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. A seated adult South African man in a plain T-shirt slowly turns his head comfortably to his left for a neck movement assessment. A female physiotherapist in muted blue scrubs observes from a separate chair. Hands rest independently on laps. Waist-up, no manual manipulation. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

### sports

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. A South African adult woman in modest exercise clothing performs a shallow bodyweight squat, both feet flat and parallel, knees slightly bent, arms comfortably forward. A physiotherapist in muted blue scrubs stands separately to one side observing. Full bodies including feet, no equipment. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

### knee

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. An older South African adult woman sits upright on a simple firm chair, one knee bent with foot on floor and the other leg gently extended forward with heel on floor. A physiotherapist in muted blue scrubs sits on a separate chair observing knee movement. Full bodies and feet, hands resting on own laps, no touching. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

### shoulder

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. A South African adult woman in a plain modest short-sleeved shirt stands raising one arm sideways to shoulder height with a gentle bend in the elbow, during a shoulder movement assessment. A physiotherapist in muted blue scrubs observes from the other side at a respectful distance, hands relaxed. Frame from thighs upward, both entire arms visible. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

### mobility

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. An older South African adult man in modest casual clothing and trainers walks naturally across a spacious uncluttered room. A physiotherapist in muted blue scrubs observes walking alongside at a respectful distance. Full bodies and both feet visible, normal walking stride, no equipment. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

### exercise

> Use case: photorealistic-natural. One editorial physiotherapy photograph, landscape 4:3. A South African adult man sits upright on a simple chair practising a gentle exercise with a single continuous flat blue resistance band held between his two hands at waist height, elbows bent beside torso, hands separated slightly with band gently stretched. A physiotherapist in muted blue scrubs sits separately observing. Both people from knees upward, clear simple band with two ends held in hands, no anchors or loops. Natural daylight, warm off-white walls, light oak, neutral welcoming clinical interior and subtle blue accents. Realistic adult anatomy, hands, clothing and proportions. Calm candid professional photography, realistic skin texture and gentle warm colour grading. Keep all subjects within the central two-thirds with ample headroom and side room for arched and rounded image crops. Fictional illustrative people and setting, not actual practitioners, patients or clinic premises. No text, logos, badges, watermarks, clutter, dramatic pain, wounds or specialised equipment. Straightforward plausible poses.

## Crop review and revisions

All originals were inspected for anatomy, hands, simple exercise positions and equipment. Initial desktop arch checks exposed tight head/arm crops. Six scenes were regenerated using their own original as the reference; mobility needed no revision. Final source images and browser crops were inspected again. No visible anatomy/equipment defects were identified at review size; these remain generated illustrations, not clinical instructions.

Sports, knee and shoulder revision prompt:

> Edit this physiotherapy illustration for an arched website image container. Preserve its people, clinical subject, realistic pose, clothing, warm daylight, neutral room and restrained blue accents. Recompose as a noticeably wider camera view with the people SMALLER and clustered within the middle 55% of the frame. Leave the TOP 28% of the image as uncluttered neutral wall above every head. Leave generous empty space on both left and right. Every head and all hands must be clearly inside the central arch-safe area, not close to top corners. Keep bodies and exercise clearly visible, with realistic proportions, hands, equipment and a physically plausible scene. Landscape 4:3. No words, badges, logos or watermarks. This is fictional illustrative imagery, not actual practitioners or premises.

Consultation, neck and exercise revision prompt:

> Recompose this editorial physiotherapy photograph for a rounded arch crop. Preserve the same realistic people, natural hands and simple pose, subject, modest clothes, natural daylight, off-white clinical interior and blue accents. Pull the camera back modestly: leave the upper 25 percent as neutral wall above both heads, and center both people inside the middle 65 percent of the image width. Keep faces, hair, hands and any exercise band well away from top corners and side edges. Landscape 4:3. Anatomically correct. No text, logos, watermarks or specialised equipment. Fictional illustration, not actual practice people or rooms.

Technical reference: [MDN image element, responsive sources and loading attributes](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img).

