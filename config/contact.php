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
        'address' => env('CONTACT_ADDRESS', 'Suite 102, Surgiklin Studios, Unit 12, Glen Eagle Office Park, Koorsboom Avenue, Glen Marais, Kempton Park, 1619, Gauteng, South Africa'),
        'location_verified' => env('CONTACT_LOCATION_VERIFIED', true),
        'street' => env('CONTACT_STREET', 'Suite 102, Surgiklin Studios, Unit 12, Glen Eagle Office Park, Koorsboom Avenue, Glen Marais'),
        'locality' => env('CONTACT_LOCALITY', 'Kempton Park'),
        'region' => env('CONTACT_REGION', 'Gauteng'),
        'postcode' => env('CONTACT_POSTCODE', '1619'),
        'country' => 'ZA',
        'arrival' => 'At the entrance gate, press the access button and wait to be let in. Once inside, park and enter the building. Follow the passage on your left to the end, where you will find Danks & Strydom Physiotherapy.',
        'access' => 'Parking and covered parking are available. The building has ramp access and an elevator.',
        'hours' => env('CONTACT_HOURS', 'Monday–Friday: 07:30–17:30. Saturday: By appointment. Sunday and public holidays: Closed.'),
        'map_embed_url' => env('CONTACT_MAP_EMBED_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3583.7425911415435!2d28.2610527!3d-26.074667599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e9515b5389c59e3%3A0xc9913cffe2473c26!2sDanks%20And%20Strydom!5e0!3m2!1sen!2sza!4v1789387905460!5m2!1sen!2sza'),
        'directions_url' => env('CONTACT_DIRECTIONS_URL', 'https://maps.app.goo.gl/WoxWSjSzNbtEkTr66'),
    ],
];
