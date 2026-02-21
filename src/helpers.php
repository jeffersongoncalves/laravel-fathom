<?php

use JeffersonGoncalves\Fathom\Settings\FathomSettings;

if (! function_exists('fathom_settings')) {
    function fathom_settings(): FathomSettings
    {
        return app(FathomSettings::class);
    }
}
