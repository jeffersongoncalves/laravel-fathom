<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Values
    |--------------------------------------------------------------------------
    |
    | These values are used as defaults when seeding the settings table
    | via the settings migration. Once migrated, settings are managed
    | from the database and these values are only used as initial seeds.
    |
    */

    'defaults' => [
        'website_id' => env('FATHOM_SITE'),
        'canonical' => true,
        'auto' => true,
        'spa' => null,       // Values: 'auto', 'history', 'hash', or null
        'honor_dnt' => null,  // true, false, or null
    ],

    /*
    |--------------------------------------------------------------------------
    | Backward Compatibility (Legacy)
    |--------------------------------------------------------------------------
    |
    | These keys are kept for backward compatibility with the settings
    | migration. If you previously used these top-level keys, they will
    | be picked up as fallback defaults during migration.
    |
    */

    'website_id' => env('FATHOM_SITE'),
    'canonical' => true,
    'auto' => true,
    'spa' => null,
    'honor_dnt' => null,
];
