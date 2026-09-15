<?php

return [
    'indexable' => env('SITE_INDEXABLE', false),
    'canonical_redirects' => env('SITE_CANONICAL_REDIRECTS', false),
    'alternate_hosts' => ['danksandstrydom.co.za', 'www.danksandstrydom.co.za'],
    'analytics_enabled' => env('SITE_ANALYTICS_ENABLED', false),
    'review_preview' => env('SITE_REVIEW_PREVIEW', false),
    'review_username' => env('SITE_REVIEW_USERNAME', ''),
    'review_password_hash' => env('SITE_REVIEW_PASSWORD_HASH', ''),
    'pages' => [
        'about' => [
            'path' => '/about',
            'published' => true,
            'title' => 'About Danks & Strydom',
            'description' => 'Meet Elize Strydom and Cheryl Myburgh at Danks & Strydom Physiotherapy in Glen Marais, Kempton Park.',
            'heading' => 'About Danks & Strydom',
            'intro' => 'Danks & Strydom is a physiotherapy practice in Glen Marais, Kempton Park. Elize Strydom and Cheryl Myburgh both hold degrees in physiotherapy.',
            'sections' => [
                'Our services' => 'Both physiotherapists provide back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation.',
            ],
            'practitioners' => [
                [
                    'name' => 'Cheryl Myburgh',
                    'title' => 'Physiotherapist',
                    'biography' => 'Cheryl Myburgh has extensive experience in human and equine physiotherapy. At Danks & Strydom, she provides physiotherapy care for patients attending the practice.',
                    // Supply exact degree/qualification titles and awarding universities as lists.
                    // Both physiotherapy degrees and the short biography above are already confirmed.
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
                    'biography' => 'Elize Strydom practises human physiotherapy at Danks & Strydom, assessing patients and providing treatment based on their individual needs.',
                    // Supply exact degree/qualification titles and awarding universities as lists.
                    // Both physiotherapy degrees and the short biography above are already confirmed.
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
            'intro' => 'Request an appointment or ask the practice a question. An enquiry does not confirm an appointment.',
            'sections' => [
                'Arranging an appointment' => 'Please arrange an appointment before visiting. Call the practice during opening hours to check availability, including appointments for the same day. You can also request an appointment by email or through our website.',
                'When your booking is confirmed' => 'Walk-ins can be accommodated only when an appointment slot is available; please speak to reception on arrival. Website and email enquiries are appointment requests. Your appointment is confirmed once the practice agrees a date and time with you.',
            ],
        ],
        'services' => [
            'path' => '/services',
            'published' => true,
            'title' => 'Physiotherapy Services in Kempton Park',
            'description' => 'Explore physiotherapy services at Danks & Strydom in Glen Marais, Kempton Park. Discuss your needs and request an assessment.',
            'heading' => 'Physiotherapy services',
            'intro' => 'Explore our physiotherapy services, provided by Elize Strydom and Cheryl Myburgh.',
            'sections' => [
                'Preparing for your visit' => 'Patients are not expected to bring anything to their appointment.',
                'Request an appointment' => 'Contact the practice to discuss availability. Sending an enquiry does not confirm an appointment.',
            ],
        ],
        'sports-injury-rehabilitation' => [
            'path' => '/services/sports-injury-rehabilitation',
            'published' => true,
            'title' => 'Sports Physio in Kempton Park',
            'description' => 'Ask Danks & Strydom in Glen Marais about sports injury rehabilitation and arranging a physiotherapy appointment.',
            'heading' => 'Sports injury rehabilitation',
            'intro' => 'Danks & Strydom offers sports injury rehabilitation in Glen Marais, Kempton Park.',
            'sections' => [
                'Your first appointment' => 'Whether an injury is affecting your sport, training or everyday movement, an assessment helps identify the next step. After completing a patient-information form, you will discuss the injury, your activity and your goals. Your physiotherapist will assess the affected area and relevant movements, then discuss treatment and rehabilitation suited to your needs. Guidance on returning to activity will depend on your assessment and progress.',
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Contact the practice to discuss your needs and arrange an assessment.',
                'Appointment length and preparation' => 'Appointments are one hour. Patients are not expected to bring anything to their appointment.',
                'Follow-up appointments' => 'Your physiotherapist will discuss whether further appointments are needed and when you should return. Follow-up timing depends on your assessment and progress. If you need advice before your next appointment, contact the practice by telephone or message to discuss whether an earlier visit is needed.',
            ],
            'card_title' => 'Sports Injury Rehabilitation',
            'service_icon' => 'pulse',
        ],
        'back-neck-pain' => [
            'path' => '/services/back-neck-pain',
            'published' => true,
            'title' => 'Back & Neck Pain Physio in Kempton Park',
            'description' => 'Ask Danks & Strydom in Glen Marais about physiotherapy for back and neck pain and arranging an assessment.',
            'heading' => 'Back and neck pain',
            'intro' => 'Danks & Strydom offers physiotherapy for back and neck pain in Glen Marais, Kempton Park.',
            'sections' => [
                'Your first appointment' => 'Back or neck pain can make everyday activities uncomfortable. At your first appointment, you will complete a patient-information form and discuss your symptoms, how they affect your daily activities and what you would like help with. Your physiotherapist will assess your movement and the affected area, explain the findings and discuss appropriate treatment. Advice and any exercises will be tailored to your assessment.',
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Contact the practice to discuss your needs and arrange an assessment.',
                'Appointment length and preparation' => 'Appointments are one hour. Patients are not expected to bring anything to their appointment.',
                'Follow-up appointments' => 'Your physiotherapist will discuss whether further appointments are needed and when you should return. Follow-up timing depends on your assessment and progress. If you need advice before your next appointment, contact the practice by telephone or message to discuss whether an earlier visit is needed.',
            ],
            'card_title' => 'Back & Neck Pain Treatment',
            'service_icon' => 'spine',
        ],
        'post-operative-rehabilitation' => [
            'path' => '/services/post-operative-rehabilitation',
            'published' => true,
            'title' => 'Post-Operative Physio in Kempton Park',
            'description' => 'Enquire about physiotherapy after surgery at Danks & Strydom in Glen Marais, Kempton Park.',
            'heading' => 'Rehabilitation after surgery',
            'intro' => 'Danks & Strydom offers post-operative rehabilitation in Glen Marais, Kempton Park. Contact the practice to discuss your procedure and appointment availability.',
            'sections' => [
                'Your first appointment' => 'Physiotherapy after surgery is tailored to your procedure and stage of recovery. At your first appointment, you will complete a patient-information form and discuss your operation, current difficulties and any instructions or restrictions given by your surgical team. Your physiotherapist will assess your movement and function and discuss appropriate treatment and rehabilitation.',
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Contact the practice to discuss your needs and arrange an assessment.',
                'Appointment length and preparation' => 'Appointments are one hour. Patients are not expected to bring anything to their appointment.',
                'Follow-up appointments' => 'Your physiotherapist will discuss whether further appointments are needed and when you should return. Follow-up timing depends on your assessment and progress. If you need advice before your next appointment, contact the practice by telephone or message to discuss whether an earlier visit is needed.',
            ],
            'card_title' => 'Post-Operative Rehabilitation',
            'service_icon' => 'recovery',
        ],
        'joint-muscle-pain' => [
            'path' => '/services/joint-muscle-pain',
            'published' => true,
            'title' => 'Joint & Muscle Pain Physio in Kempton Park',
            'description' => 'Discuss joint discomfort, muscular aches and movement difficulties with Danks & Strydom in Glen Marais, Kempton Park.',
            'heading' => 'Joint & Muscle Pain',
            'intro' => 'Joint discomfort or muscular aches can make ordinary movements difficult. You can enquire about an assessment when discomfort affects the activities that matter to you. Contact Danks & Strydom in Glen Marais, Kempton Park to discuss your needs.',
            'card_title' => 'Joint & Muscle Pain',
            'service_icon' => 'joint',
            'card_description' => 'Assessment of joint discomfort, muscular aches and difficulties with everyday movement.',
            'sections' => [
                'Understanding your discomfort' => 'During your one-hour appointment, you will complete a patient-information form and discuss where you feel discomfort and which movements are difficult. The physiotherapist may look at movement of the affected area and how you manage relevant everyday tasks.',
                'Care based on your assessment' => 'Assessment comes before appropriate treatment. Your physiotherapist will discuss the findings and consider treatment or guidance in relation to your difficulties and goals. The approach depends on the findings and your goals.',
                'Reviewing movement and comfort' => 'Your physiotherapist will discuss whether another appointment would be useful. Follow-up can revisit the movements or activities you found difficult and help guide any changes to your care.',
                'Request an appointment' => 'Call the practice, email or use the website enquiry form to request an appointment. An enquiry does not confirm a booking.',
            ],
            'related_services' => [
                'mobility-movement-assessment',
                'back-neck-pain',
            ],
        ],
        'mobility-movement-assessment' => [
            'path' => '/services/mobility-movement-assessment',
            'published' => true,
            'title' => 'Movement Assessment in Glen Marais, Kempton Park',
            'description' => 'Enquire about movement limitations and their effect on daily activities at Danks & Strydom Physiotherapy in Glen Marais.',
            'heading' => 'Mobility & Movement Assessment',
            'intro' => 'If bending, reaching, walking or other everyday movements feel limited, a mobility and movement assessment offers a way to discuss those difficulties. The focus is on understanding how movement affects your daily activities. Contact Danks & Strydom in Glen Marais, Kempton Park to discuss your needs.',
            'card_title' => 'Mobility & Movement Assessment',
            'service_icon' => 'mobility',
            'card_description' => 'Understand movement limitations and how they affect the activities that matter to you.',
            'sections' => [
                'Looking at everyday movement' => 'Your first appointment is one hour and starts with a patient-information form. You can describe the activities you find difficult and what you would like to do more comfortably. Your physiotherapist may observe relevant movements and assess limitations in relation to those activities.',
                'Discussing the next step' => 'The assessment informs any proposed treatment or guidance. Your physiotherapist will explain the findings and discuss an approach suited to your needs.',
                'Checking changes over time' => 'If further appointments are appropriate, you will discuss when to return and which movements or daily activities to review. Progress and any continuing difficulties help inform the next discussion.',
                'Request an appointment' => 'Call the practice, email or use the website enquiry form to request an appointment. An enquiry does not confirm a booking.',
            ],
            'related_services' => [
                'joint-muscle-pain',
                'rehabilitation-exercise-programmes',
            ],
        ],
        'chronic-pain-management' => [
            'path' => '/services/chronic-pain-management',
            'published' => true,
            'title' => 'Persistent Pain Support in Kempton Park',
            'description' => 'Discuss persistent pain and everyday function with Danks & Strydom in Glen Marais. Enquire about an individual physiotherapy assessment.',
            'heading' => 'Chronic Pain Management',
            'intro' => 'Persistent pain can affect daily activities and how confident you feel about movement. Chronic pain management focuses on discussing those effects and exploring support for everyday function, without promising a cure. Contact Danks & Strydom in Glen Marais, Kempton Park to discuss your needs.',
            'card_title' => 'Chronic Pain Management',
            'service_icon' => 'chronic',
            'card_description' => 'Discuss persistent pain and support for everyday function through an individual assessment.',
            'sections' => [
                'Time to discuss your experience' => 'At your one-hour first appointment, you will complete a patient-information form and discuss your pain, how it affects your routine and the activities you would like help with. Your physiotherapist may assess movements relevant to those concerns.',
                'An individual approach' => 'Your assessment guides the discussion about appropriate treatment or advice. Your physiotherapist will consider your experience and goals when discussing manageable next steps.',
                'Ongoing review' => 'You and your physiotherapist can discuss whether follow-up would be useful and when to return. Reviews offer an opportunity to talk about changes in daily function, difficulties with guidance and whether the approach needs adjusting.',
                'Request an appointment' => 'Call the practice, email or use the website enquiry form to request an appointment. An enquiry does not confirm a booking.',
            ],
            'related_services' => [
                'joint-muscle-pain',
                'rehabilitation-exercise-programmes',
            ],
        ],
        'injury-prevention' => [
            'path' => '/services/injury-prevention',
            'published' => true,
            'title' => 'Injury Risk & Movement Assessment in Kempton Park',
            'description' => 'Ask Danks & Strydom in Glen Marais about movement, activity demands and guidance to help reduce injury risk. Prevention is not guaranteed.',
            'heading' => 'Injury Prevention',
            'intro' => 'You may wish to enquire when preparing for an activity or considering the demands it places on your movement. Injury prevention involves assessing relevant movement and discussing ways to reduce risk; it cannot guarantee that an injury will not happen. Contact Danks & Strydom in Glen Marais, Kempton Park to discuss your needs.',
            'card_title' => 'Injury Prevention',
            'service_icon' => 'shield',
            'card_description' => 'Assess movement and activity demands, and discuss ways to reduce injury risk.',
            'sections' => [
                'Your activity and its demands' => 'The first appointment is one hour. After completing a patient-information form, you can discuss your activity, any concerns and what you would like guidance on. Your physiotherapist may assess movements relevant to those demands before suggesting an approach.',
                'Guidance that fits the assessment' => 'Advice is based on the assessment and the activity you have discussed. Your physiotherapist will explain relevant considerations and possible adjustments to suit your activity.',
                'Revisiting your needs' => 'Follow-up is discussed according to your assessment and circumstances. If your activity or movement demands change, a review can help you discuss whether the guidance should change too.',
                'Request an appointment' => 'Call the practice, email or use the website enquiry form to request an appointment. An enquiry does not confirm a booking.',
            ],
            'related_services' => [
                'mobility-movement-assessment',
                'sports-injury-rehabilitation',
            ],
        ],
        'rehabilitation-exercise-programmes' => [
            'path' => '/services/rehabilitation-exercise-programmes',
            'published' => true,
            'title' => 'Rehabilitation Exercise Guidance in Kempton Park',
            'description' => 'Enquire about individually guided rehabilitation exercise, progression and follow-up at Danks & Strydom in Glen Marais, Kempton Park.',
            'heading' => 'Rehabilitation Exercise Programmes',
            'intro' => 'A rehabilitation exercise programme provides individual guidance for exercises selected to support your rehabilitation. You may enquire when you would like help understanding an exercise approach and how it relates to your movement goals. Contact Danks & Strydom in Glen Marais, Kempton Park to discuss your needs.',
            'card_title' => 'Rehabilitation Exercise Programmes',
            'service_icon' => 'program',
            'card_description' => 'Individual exercise guidance, progression and follow-up to support your rehabilitation.',
            'sections' => [
                'Assessment before an exercise plan' => 'At your one-hour first appointment, you will complete a patient-information form and discuss your current difficulties and rehabilitation goals. Your physiotherapist may assess relevant movements and function before deciding what exercise guidance is appropriate.',
                'Individual guidance and progression' => 'Exercises and guidance are selected in relation to your assessment. Your physiotherapist will discuss how to approach the programme and how any progression will be considered.',
                'Reviewing the programme' => 'Follow-up gives you an opportunity to discuss how the exercises are going, any difficulties and whether changes are appropriate. Your physiotherapist will discuss the timing of reviews according to your needs and progress.',
                'Request an appointment' => 'Call the practice, email or use the website enquiry form to request an appointment. An enquiry does not confirm a booking.',
            ],
            'related_services' => [
                'post-operative-rehabilitation',
                'mobility-movement-assessment',
            ],
        ],
        'patient-information' => [
            'path' => '/patient-information',
            'published' => true,
            'title' => 'Patient Information',
            'description' => 'Prepare for your visit to Danks & Strydom Physiotherapy in Glen Marais, Kempton Park. Contact the practice for appointment and payment details.',
            'heading' => 'Before your first appointment',
            'intro' => 'Practical information to help you arrange your appointment and prepare for your visit.',
            // Optional additions: null bodies stay hidden publicly; preview labels identify missing facts.
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
