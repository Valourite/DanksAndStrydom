<?php

return [
    // Generated illustrations, never practitioner portraits or photographs of the practice.
    'images' => [
        'consultation' => [
            'path' => 'images/illustrations/consultation-1200.webp',
            'alt' => 'Illustrative consultation between an adult patient and a physiotherapist',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/consultation-480.webp', 768 => 'images/illustrations/consultation-768.webp', 1200 => 'images/illustrations/consultation-1200.webp'],
        ],
        'neck' => [
            'path' => 'images/illustrations/neck-1200.webp',
            'alt' => 'Illustrative seated neck movement assessment',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/neck-480.webp', 768 => 'images/illustrations/neck-768.webp', 1200 => 'images/illustrations/neck-1200.webp'],
        ],
        'sports' => [
            'path' => 'images/illustrations/sports-1200.webp',
            'alt' => 'Illustrative supervised bodyweight exercise',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/sports-480.webp', 768 => 'images/illustrations/sports-768.webp', 1200 => 'images/illustrations/sports-1200.webp'],
        ],
        'knee' => [
            'path' => 'images/illustrations/knee-1200.webp',
            'alt' => 'Illustrative gentle seated knee rehabilitation',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/knee-480.webp', 768 => 'images/illustrations/knee-768.webp', 1200 => 'images/illustrations/knee-1200.webp'],
        ],
        'shoulder' => [
            'path' => 'images/illustrations/shoulder-1200.webp',
            'alt' => 'Illustrative shoulder movement assessment',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/shoulder-480.webp', 768 => 'images/illustrations/shoulder-768.webp', 1200 => 'images/illustrations/shoulder-1200.webp'],
        ],
        'mobility' => [
            'path' => 'images/illustrations/mobility-1200.webp',
            'alt' => 'Illustrative walking and mobility assessment',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/mobility-480.webp', 768 => 'images/illustrations/mobility-768.webp', 1200 => 'images/illustrations/mobility-1200.webp'],
        ],
        'exercise' => [
            'path' => 'images/illustrations/exercise-1200.webp',
            'alt' => 'Illustrative guided resistance-band exercise',
            'width' => 1200,
            'height' => 900,
            'variants' => [480 => 'images/illustrations/exercise-480.webp', 768 => 'images/illustrations/exercise-768.webp', 1200 => 'images/illustrations/exercise-1200.webp'],
        ],
    ],
    'pages' => [
        '/' => 'consultation',
        '/about' => 'shoulder',
        '/contact' => 'consultation',
        '/services' => 'mobility',
        '/services/sports-injury-rehabilitation' => 'sports',
        '/services/back-neck-pain' => 'neck',
        '/services/post-operative-rehabilitation' => 'knee',
        '/services/joint-muscle-pain' => 'shoulder',
        '/services/mobility-movement-assessment' => 'mobility',
        '/services/chronic-pain-management' => 'consultation',
        '/services/injury-prevention' => 'sports',
        '/services/rehabilitation-exercise-programmes' => 'exercise',
        '/patient-information' => 'neck',
    ],
];
