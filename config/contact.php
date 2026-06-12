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
        'map_embed_url' => env('CONTACT_MAP_EMBED_URL', "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7167.225550505287!2d28.24767237619273!3d-26.078908558884297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e9514d786f1b4bf%3A0x32e2cb459495985a!2s196%20Monument%20Rd%2C%20Glen%20marais%2C%20Johannesburg%2C%201619!5e0!3m2!1sen!2sza!4v1781261967043!5m2!1sen!2sza"),
    ],

];
