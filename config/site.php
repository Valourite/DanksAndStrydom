<?php

return [
    'indexable' => env('SITE_INDEXABLE', false),
    'canonical_redirects' => env('SITE_CANONICAL_REDIRECTS', false),
    'alternate_hosts' => ['danksandstrydom.co.za', 'www.danksandstrydom.co.za'],
    'analytics_enabled' => env('SITE_ANALYTICS_ENABLED', false),
    'pages' => [
        'about' => [
            'path' => '/about',
            'published' => true,
            'title' => 'About Danks & Strydom',
            'description' => 'Meet Elize Strydom and Cheryl Myburgh at Danks & Strydom Physiotherapy in Glen Marais, Kempton Park.',
            'heading' => 'About Danks & Strydom',
            'intro' => 'Danks & Strydom is a physiotherapy practice in Glen Marais, Kempton Park. Elize Strydom and Cheryl Myburgh both hold degrees in physiotherapy.',
            'sections' => [
                'Care that starts with you' => 'Your first visit starts with an assessment of what is troubling you and the activities you want help with. Both physiotherapists provide back and neck pain care, sports injury rehabilitation and post-operative rehabilitation.',
            ],
            'practitioners' => [
                [
                    'name' => 'Cheryl Myburgh',
                    'title' => 'Physiotherapist',
                    // Editable draft using supplied facts only; equine experience is biographical, not a practice service.
                    'biography' => 'Cheryl Myburgh is a physiotherapist with a degree in physiotherapy and extensive experience in human and equine physiotherapy.',
                    // Supply exact degree/qualification titles and awarding universities as lists.
                    // Physiotherapy degrees and the facts used in the draft above are already confirmed.
                    'qualifications' => [],
                    'universities' => [],
                    // Optional longer factual biography; do not replace confirmed wording with filler.
                    'expanded_biography' => null,
                    // Supply the languages this practitioner offers consultations in.
                    'languages' => [],
                    // Supply an approved portrait's public-relative asset path and descriptive alt text together.
                    'photo' => ['path' => null, 'alt' => null],
                ],
                [
                    'name' => 'Elize Strydom',
                    'title' => 'Physiotherapist',
                    // Editable draft using supplied facts only.
                    'biography' => 'Elize Strydom is a physiotherapist with a degree in physiotherapy and experience in human physiotherapy.',
                    // Supply exact degree/qualification titles and awarding universities as lists.
                    // Physiotherapy degrees and the facts used in the draft above are already confirmed.
                    'qualifications' => [],
                    'universities' => [],
                    // Optional longer factual biography; do not replace confirmed wording with filler.
                    'expanded_biography' => null,
                    // Supply the languages this practitioner offers consultations in.
                    'languages' => [],
                    // Supply an approved portrait's public-relative asset path and descriptive alt text together.
                    'photo' => ['path' => null, 'alt' => null],
                ],
            ],
        ],
        'contact' => [
            'path' => '/contact',
            'published' => true,
            'title' => 'Contact & Directions',
            'description' => 'Contact Danks & Strydom Physiotherapy in Glen Marais, Kempton Park. Request an appointment and confirm directions before your visit.',
            'heading' => 'Contact and directions',
            'intro' => 'Get in touch with reception to request a time, ask a practical question or find the rooms.',
            'sections' => [
                'Arranging an appointment' => 'Call during opening hours for availability, including same-day appointments. You can also send a request by email or through the form below.',
                'When your booking is confirmed' => 'Reception will confirm a date and time with you. For preparation, payment and cancellation details, read Patient Information before your visit.',
            ],
        ],
        'services' => [
            'path' => '/services',
            'published' => true,
            'title' => 'Physiotherapy Services in Kempton Park',
            'description' => 'Explore physiotherapy services at Danks & Strydom in Glen Marais, Kempton Park. Find care for pain, movement and rehabilitation.',
            'heading' => 'Physiotherapy services',
            'intro' => 'Find support for pain, movement difficulties and rehabilitation. Explore the eight services below to see which focus most closely matches what you want help with.',
            'sections' => [
                'Not sure where to start?' => 'You do not need to identify the cause of a problem or choose a treatment before booking. Tell reception what you would like help with and arrange a first assessment.',
            ],
        ],
        'sports-injury-rehabilitation' => [
            'path' => '/services/sports-injury-rehabilitation',
            'published' => true,
            'title' => 'Sports Physio in Kempton Park',
            'description' => 'Physiotherapy for sports injuries, from assessing painful movements to planning a gradual return to activity at Danks & Strydom in Kempton Park.',
            'heading' => 'Sports injury rehabilitation',
            'intro' => 'An injury can interrupt training and make movements you normally take for granted feel difficult. Sports rehabilitation focuses on the demands of your activity and the steps towards taking part again.',
            'sections' => [
                'Your sport and your starting point' => 'Tell us how the injury happened, what has changed in your training and which activities you want to return to. Pain, weakness or difficulty with a particular movement can all be useful starting points for an assessment.',
                'Looking beyond the painful movement' => 'The assessment may explore movement, strength and how the affected area responds to tasks relevant to your sport. Your recent activity and current abilities help establish a starting point for rehabilitation.',
                'Building towards activity' => 'Rehabilitation may involve guided exercise and changes to activity while you recover. The aim is to work towards the movements your sport requires, with progression based on your response rather than a fixed return date.',
                'Reviewing readiness' => 'Follow-up can revisit the tasks that were difficult, your confidence in movement and how you have managed activity between visits. Together, you and your physiotherapist can decide what to build on and what still needs attention.',
            ],
            'card_title' => 'Sports Injury Rehabilitation',
            'service_icon' => 'pulse',
            'card_description' => 'Care for injuries affecting training, sport and a return to activity.',
            'related_services' => ['injury-prevention', 'rehabilitation-exercise-programmes'],
        ],
        'back-neck-pain' => [
            'path' => '/services/back-neck-pain',
            'published' => true,
            'title' => 'Back & Neck Pain Physio in Kempton Park',
            'description' => 'Physiotherapy for back and neck pain at Danks & Strydom in Glen Marais. Explore support for everyday movement, comfort and activity.',
            'heading' => 'Back and neck pain',
            'intro' => 'Back or neck pain can make sitting, turning, lifting or sleeping uncomfortable. Physiotherapy looks at how symptoms affect your day and helps you find a practical way forward.',
            'sections' => [
                'How pain affects your day' => 'You might want help with stiffness on turning your head, discomfort during desk work or difficulty bending and lifting. Explain when symptoms appear, what changes them and which parts of your routine have become harder.',
                'Understanding movement' => 'Your physiotherapist may check comfortable movement, the affected area and relevant everyday tasks. The assessment brings your symptoms and activity together rather than assuming that one posture or movement explains every problem.',
                'Finding workable next steps' => 'Care may include exercise guidance and advice on approaching activities more comfortably. Treatment is selected after the assessment, with room to ask questions and understand how the plan fits your routine.',
                'Noticing meaningful changes' => 'At follow-up, changes in movement and day-to-day comfort help show how the plan is working. Your physiotherapist can adjust guidance if difficulties continue or your activity changes.',
            ],
            'card_title' => 'Back & Neck Pain Treatment',
            'service_icon' => 'spine',
            'card_description' => 'Support for back and neck discomfort affecting work, rest and daily movement.',
            'related_services' => ['joint-muscle-pain', 'chronic-pain-management'],
        ],
        'post-operative-rehabilitation' => [
            'path' => '/services/post-operative-rehabilitation',
            'published' => true,
            'title' => 'Post-Operative Physio in Kempton Park',
            'description' => 'Physiotherapy after surgery in Glen Marais, Kempton Park. Rehabilitation shaped around your operation, surgical guidance and everyday recovery goals.',
            'heading' => 'Rehabilitation after surgery',
            'intro' => 'After surgery, everyday tasks can take more effort. Post-operative rehabilitation supports movement and function while taking account of your procedure and the guidance from your surgical team.',
            'sections' => [
                'Starting from your operation' => 'Tell your physiotherapist about the operation, your current difficulties and any restrictions or instructions from your surgical team. Getting around, managing stairs or returning to ordinary tasks may be priorities, depending on the procedure.',
                'Checking your current abilities' => 'The assessment may look at movement, strength and how you manage relevant activities within those restrictions. Your stage of recovery matters when deciding which tasks are appropriate to assess.',
                'Rehabilitation at an appropriate pace' => 'Treatment may include guided movement and rehabilitation exercises suited to your current abilities. Progression should remain consistent with surgical instructions; a programme for one operation will not necessarily suit another.',
                'Following your recovery' => 'Reviews provide time to check function, ask questions about the programme and consider the next steps. Changes in surgical advice or difficulties between visits can affect how rehabilitation progresses.',
            ],
            'card_title' => 'Post-Operative Rehabilitation',
            'service_icon' => 'recovery',
            'card_description' => 'Rehabilitation shaped around your operation, recovery stage and daily activities.',
            'related_services' => ['rehabilitation-exercise-programmes', 'mobility-movement-assessment'],
        ],
        'joint-muscle-pain' => [
            'path' => '/services/joint-muscle-pain',
            'published' => true,
            'title' => 'Joint & Muscle Pain Physio in Kempton Park',
            'description' => 'Assessment and physiotherapy for joint discomfort and muscular aches at Danks & Strydom in Kempton Park, with everyday movement in mind.',
            'heading' => 'Joint & Muscle Pain',
            'intro' => 'A sore joint or aching muscle can make reaching, walking or carrying things uncomfortable. This service focuses on the affected area and the everyday movements you want to manage more easily.',
            'card_title' => 'Joint & Muscle Pain',
            'service_icon' => 'joint',
            'sections' => [
                'The difficulties you notice' => 'Pain, stiffness or weakness may affect one movement or several activities. You can describe where you feel it, when it started and whether the pattern changes through the day or after activity.',
                'Examining the affected area' => 'An assessment may explore joint movement, muscle function and tasks that reproduce your difficulty. Your physiotherapist will consider your account alongside these findings before explaining possible next steps.',
                'Treatment with a practical focus' => 'Care may involve movement guidance or exercises suited to the affected area. The plan connects treatment to a useful goal, such as reaching more comfortably or managing a daily task, rather than treating discomfort in isolation.',
                'Checking the response' => 'Follow-up can compare comfort, movement and the tasks that first brought you in. Your response helps determine whether to continue, adjust the approach or reconsider what support is needed.',
            ],
            'card_description' => 'Assessment of joint discomfort, muscular aches and difficulties with everyday movement.',
            'related_services' => ['mobility-movement-assessment', 'back-neck-pain'],
        ],
        'mobility-movement-assessment' => [
            'path' => '/services/mobility-movement-assessment',
            'published' => true,
            'title' => 'Movement Assessment in Glen Marais, Kempton Park',
            'description' => 'Understand difficulties with walking, bending or reaching through a movement assessment at Danks & Strydom in Glen Marais, Kempton Park.',
            'heading' => 'Mobility & Movement Assessment',
            'intro' => 'Movement can feel limited even when pain is not the main concern. A mobility and movement assessment looks at what is difficult, how you manage it and what you would like to do more easily.',
            'card_title' => 'Mobility & Movement Assessment',
            'service_icon' => 'mobility',
            'sections' => [
                'Start with an everyday task' => 'Perhaps reaching a shelf feels restricted, getting up from a chair takes effort or walking feels less comfortable than before. Choose the activities that matter most so the assessment has a clear focus.',
                'Looking at how you move' => 'Your physiotherapist may observe those tasks and check relevant movement, strength or balance. The aim is to understand the limitation in context, including how it affects your independence and routine.',
                'Turning findings into a plan' => 'The next step may be guidance for a particular task, an exercise approach or further treatment. The assessment helps identify which support is relevant; you do not need to choose a programme before your first visit.',
                'Revisiting the same tasks' => 'If follow-up is useful, repeating meaningful tasks can help track change. You can also raise new difficulties or activities you would like to work towards.',
            ],
            'card_description' => 'Understand movement limitations and how they affect the activities that matter to you.',
            'related_services' => ['joint-muscle-pain', 'rehabilitation-exercise-programmes'],
        ],
        'chronic-pain-management' => [
            'path' => '/services/chronic-pain-management',
            'published' => true,
            'title' => 'Persistent Pain Support in Kempton Park',
            'description' => 'Physiotherapy support for persistent pain in Glen Marais. Work towards manageable activity and everyday function with Danks & Strydom.',
            'heading' => 'Chronic Pain Management',
            'intro' => 'Living with persistent pain can affect your routine, energy and confidence in movement. Physiotherapy offers support for finding manageable ways to stay involved in the activities that matter to you.',
            'card_title' => 'Chronic Pain Management',
            'service_icon' => 'chronic',
            'sections' => [
                'Your experience matters' => 'There is time to explain how pain affects work, rest and the things you enjoy, including what you have already tried. A useful goal might be doing an everyday activity more comfortably or feeling more confident about moving.',
                'A broader view of activity' => 'Assessment may explore relevant movements, your usual activity pattern and how symptoms respond. Both easier and more difficult days help build a picture of what is manageable for you.',
                'Working towards manageable goals' => 'Guidance may involve finding a suitable starting level of activity and gradually adapting it. The focus is on practical steps that fit your circumstances, with treatment selected around your assessment and priorities.',
                'Progress beyond a pain score' => 'Reviews can consider what you are able to do, how confident you feel and how the plan works on difficult days. These changes matter alongside symptoms and can help shape ongoing support.',
            ],
            'card_description' => 'Support for living with persistent pain and building manageable everyday activity.',
            'related_services' => ['joint-muscle-pain', 'rehabilitation-exercise-programmes'],
        ],
        'injury-prevention' => [
            'path' => '/services/injury-prevention',
            'published' => true,
            'title' => 'Injury Risk & Movement Assessment in Kempton Park',
            'description' => 'Prepare for activity with movement assessment and injury-risk guidance at Danks & Strydom Physiotherapy in Glen Marais, Kempton Park.',
            'heading' => 'Injury Prevention',
            'intro' => 'Starting an activity, returning after a break or increasing its demands can raise questions about preparation. Injury prevention focuses on understanding those demands and reducing avoidable risks.',
            'card_title' => 'Injury Prevention',
            'service_icon' => 'shield',
            'sections' => [
                'Preparing for your activity' => 'You may be starting a sport, returning after time away or finding that an old difficulty affects a new activity. Your history, current activity and intended demands provide a useful starting point.',
                'Assessing relevant movement' => 'The assessment may explore movements used in your activity and areas where strength or control make a task difficult. It is a way to identify useful preparation, not a test that can predict every future injury.',
                'Making practical adjustments' => 'Guidance may cover building activity gradually, preparing for its demands and recognising when to adjust the workload. Recommendations depend on your assessment and the activity you want to pursue.',
                'Reviewing as demands change' => 'A return visit may help when your activity increases or a difficulty persists. You can review how the advice is working and whether preparation needs to change with your goals.',
            ],
            'card_description' => 'Prepare for activity with guidance informed by your movement and its demands.',
            'related_services' => ['mobility-movement-assessment', 'sports-injury-rehabilitation'],
        ],
        'rehabilitation-exercise-programmes' => [
            'path' => '/services/rehabilitation-exercise-programmes',
            'published' => true,
            'title' => 'Rehabilitation Exercise Guidance in Kempton Park',
            'description' => 'Rehabilitation exercise guidance at Danks & Strydom in Kempton Park. Individual starting points, clear progression and follow-up for your movement goals.',
            'heading' => 'Rehabilitation Exercise Programmes',
            'intro' => 'Knowing how to begin and when to progress can make rehabilitation exercises easier to follow. An individual programme connects exercise to the movement or activity you are working towards.',
            'card_title' => 'Rehabilitation Exercise Programmes',
            'service_icon' => 'program',
            'sections' => [
                'A starting point that fits you' => 'Bring your questions about exercise, including movements you find difficult or parts of a previous programme you are unsure about. Your physiotherapist will consider your current function and rehabilitation goals before selecting exercises.',
                'Understanding the programme' => 'Guidance may cover the purpose of an exercise, how to approach it and what to do if it is difficult. Exercises can focus on relevant movement, strength or control, depending on the assessment.',
                'Progression with a reason' => 'A programme can change as tasks become more manageable. Progression may mean adjusting the exercise or its demands rather than simply adding more; the next step should relate to your goal and response.',
                'Feedback and follow-up' => 'At review, explain what has worked in your routine and where you have struggled. This gives your physiotherapist a basis for adapting the programme and clarifying how to continue between appointments.',
            ],
            'card_description' => 'Individual exercise guidance, progression and follow-up to support your rehabilitation.',
            'related_services' => ['post-operative-rehabilitation', 'mobility-movement-assessment'],
        ],
        'patient-information' => [
            'path' => '/patient-information',
            'published' => true,
            'title' => 'Patient Information',
            'description' => 'Prepare for your visit to Danks & Strydom Physiotherapy in Glen Marais, Kempton Park. Contact the practice for appointment and payment details.',
            'heading' => 'Before your first appointment',
            'intro' => 'Practical information to help you arrange your appointment and prepare for your visit.',
            // Optional additions: null bodies are omitted in every environment. Track missing facts in CONTENT-TODO.md.
            'optional_sections' => [
                // Supply current consultation fees and currency, only if amounts should be displayed.
                'consultation_fees' => ['heading' => 'Current consultation fees', 'body' => null],
                // Supply when payment is due; cash/card acceptance is already confirmed.
                'payment_timing' => ['heading' => 'When payment is due', 'body' => null],
                // Supply who submits claims and whether patients pay first; do not infer scheme coverage.
                'medical_aid_claims' => ['heading' => 'Submitting medical-aid claims', 'body' => null],
                // Supply responsibility and next steps if a medical-aid claim is declined.
                'declined_claims' => ['heading' => 'Declined medical-aid claims', 'body' => null],
                // Supply a separate missed-appointment policy, if applicable. The 24-hour cancellation policy is confirmed.
                'missed_appointments' => ['heading' => 'Missed appointments', 'body' => null],
            ],
            'sections' => [
                'Arranging an appointment' => 'Please arrange an appointment before visiting. Call the practice during opening hours to check availability, including appointments for the same day. You can also request an appointment by email or through our website.',
                'When your booking is confirmed' => 'Walk-ins can be accommodated only when an appointment slot is available; please speak to reception on arrival. Website and email enquiries are appointment requests. Your appointment is confirmed once the practice agrees a date and time with you.',
                'Your first appointment' => 'Appointments are one hour. New patients complete a patient-information form. Your physiotherapist will assess you before providing appropriate treatment.',
                'What to bring' => 'Patients are not expected to bring anything to their appointment.',
                'Follow-up appointments' => 'Your physiotherapist will discuss whether further appointments are needed and when you should return. Follow-up timing depends on your assessment and progress. If you need advice before your next appointment, contact the practice by telephone or message to discuss whether an earlier visit is needed.',
                'Referrals' => 'You can book directly with the practice without a doctor’s referral. If you intend to use medical aid, check whether your scheme has any separate requirements.',
                'Fees and payment' => 'Contact the practice for current consultation fees. Cash and card payments are accepted. Please ask reception about medical-aid payment arrangements.',
                'Medical aid' => 'Please contact reception to confirm medical-aid claim arrangements and any amount payable by you. Check your benefits and requirements with your scheme before your appointment.',
                'Cancellations and rescheduling' => 'Please give at least 24 hours’ notice if you need to cancel or reschedule. With less than 24 hours’ notice, you may be liable for the full appointment fee. Contact the practice to change your booking.',
            ],
        ],
    ],
];
