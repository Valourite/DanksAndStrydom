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
        'phone' => env('CONTACT_PHONE', '+27 00 000 0000'),
        'email' => env('CONTACT_EMAIL', 'hello@danksandstrydom.co.za'),
        'address' => env('CONTACT_ADDRESS', '123 Wellness Avenue, Suite 4, Cape Town, 8001'),
        'hours' => [
            'Monday - Friday' => '07:30 - 17:30',
            'Saturday' => 'Closed',
            'Sunday & Public Holidays' => 'Closed',
        ],
        // Replace with the real Google Maps embed URL when available.
        'map_embed_url' => env('CONTACT_MAP_EMBED_URL', ''),
    ],

];
