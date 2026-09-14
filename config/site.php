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
                'Our services' => 'Both physiotherapists provide back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation.',
            ],
            'practitioners' => [
                [
                    'name' => 'Elize Strydom',
                    'qualification' => 'Degree in physiotherapy',
                    'placeholder' => 'Approved photograph, biography and full qualification details to be added.',
                ],
                [
                    'name' => 'Cheryl Myburgh',
                    'qualification' => 'Degree in physiotherapy',
                    'placeholder' => 'Approved photograph, biography and full qualification details to be added.',
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
            ],
        ],
        'services' => [
            'path' => '/services',
            'published' => true,
            'title' => 'Physiotherapy Services in Kempton Park',
            'description' => 'Back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation in Glen Marais, Kempton Park.',
            'heading' => 'Physiotherapy services',
            'intro' => 'Explore our physiotherapy services, provided by Elize Strydom and Cheryl Myburgh.',
            'sections' => [
                'Preparing for your visit' => 'Patients are not expected to bring anything to their appointment.',
                'Request an appointment' => 'Contact the practice to discuss availability. Sending an enquiry does not confirm an appointment.',
            ],
        ],
        'back-neck-pain' => [
            'path' => '/services/back-neck-pain',
            'published' => true,
            'title' => 'Back & Neck Pain Physio in Kempton Park',
            'description' => 'Ask Danks & Strydom in Glen Marais about physiotherapy for back and neck pain and arranging an assessment.',
            'heading' => 'Back and neck pain',
            'intro' => 'Danks & Strydom offers physiotherapy for back and neck pain in Glen Marais, Kempton Park.',
            'sections' => [
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Both hold degrees in physiotherapy.',
                'What to bring' => 'Patients are not expected to bring anything to their appointment.',
            ],
            'placeholders' => [
                'What to expect' => 'Assessment and follow-up details to be added after review by the practice. Please contact us to discuss your appointment.',
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
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Both hold degrees in physiotherapy.',
                'What to bring' => 'Patients are not expected to bring anything to their appointment.',
            ],
            'placeholders' => [
                'What to expect' => 'Assessment and follow-up details to be added after review by the practice. Please contact us to discuss your appointment.',
            ],
        ],
        'post-operative-rehabilitation' => [
            'path' => '/services/post-operative-rehabilitation',
            'published' => true,
            'title' => 'Post-Operative Physio in Kempton Park',
            'description' => 'Enquire about physiotherapy after surgery at Danks & Strydom in Glen Marais, Kempton Park.',
            'heading' => 'Rehabilitation after surgery',
            'intro' => 'Danks & Strydom offers post-operative rehabilitation in Glen Marais, Kempton Park. Contact the practice to discuss your procedure and appointment availability.',
            'sections' => [
                'Your physiotherapists' => 'Elize Strydom and Cheryl Myburgh both provide this service. Both hold degrees in physiotherapy.',
                'What to bring' => 'Patients are not expected to bring anything to their appointment.',
            ],
            'placeholders' => [
                'What to expect' => 'Assessment and follow-up details to be added after review by the practice. Please contact us to discuss your appointment.',
            ],
        ],
        'patient-information' => [
            'path' => '/patient-information',
            'published' => true,
            'title' => 'Patient Information',
            'description' => 'Prepare for your visit to Danks & Strydom Physiotherapy in Glen Marais, Kempton Park. Contact the practice for appointment and payment details.',
            'heading' => 'Before your first appointment',
            'intro' => 'Find practical information for your visit. Some details are still being completed; please contact the practice about any information marked as a placeholder.',
            'sections' => [
                'What to bring' => 'Patients are not expected to bring anything to their appointment.',
                'Your physiotherapist' => 'Elize Strydom and Cheryl Myburgh both provide back and neck pain physiotherapy, sports injury rehabilitation and post-operative rehabilitation. Both hold degrees in physiotherapy.',
                'Finding the entrance' => 'Please contact the practice to confirm the patient entrance and directions before travelling.',
            ],
            'placeholders' => [
                'Appointment arrangements' => 'Availability and the appointment-confirmation process to be added. An enquiry does not confirm a booking.',
                'Fees and medical aid' => 'Fees, payment and medical-aid arrangements to be added. Contact the practice for current details.',
                'Referrals' => 'Referral requirements to be added. Contact the practice to discuss your circumstances.',
                'Changes and cancellations' => 'The change and cancellation policy to be added. Contact the practice if you need to change an appointment.',
            ],
        ],
    ],
];
