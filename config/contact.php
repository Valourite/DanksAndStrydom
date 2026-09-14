<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Form Recipients
    |--------------------------------------------------------------------------
    |
    | Email address(es) that contact form submissions are delivered to.
    | Supports a single address or a comma-separated list, e.g.
    | CONTACT_MAIL_TO="admin@example.com,info@example.com"
    |
    */

    'recipients' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('CONTACT_MAIL_TO', ''))
    ))),

    /*
    |--------------------------------------------------------------------------
    | Practice Details
    |--------------------------------------------------------------------------
    |
    | Public contact / location details shown on the site. Safe to display
    | (these are not the internal notification recipients above).
    |
    */

    'practice' => [
        'name' => 'Danks & Strydom Physiotherapy',
        'phone' => env('CONTACT_PHONE', '011 391 3126'),
        'email' => env('CONTACT_EMAIL', 'admin@danksandstrydom.co.za'),
        'address' => env('CONTACT_ADDRESS', 'Surgiklin Studios, Unit 12, Koorsboom Ave, Glen Marais, Kempton Park, 1619'),
        'location_verified' => env('CONTACT_LOCATION_VERIFIED', false),
        'street' => env('CONTACT_STREET', 'Surgiklin Studios, Unit 12, Koorsboom Ave'),
        'locality' => env('CONTACT_LOCALITY', 'Kempton Park'),
        'region' => env('CONTACT_REGION', ''),
        'postcode' => env('CONTACT_POSTCODE', '1619'),
        'country' => 'ZA',
        'hours' => env('CONTACT_HOURS', ''),
        'map_embed_url' => env('CONTACT_MAP_EMBED_URL', ''),
        'directions_url' => env('CONTACT_DIRECTIONS_URL', ''),
    ],
];
