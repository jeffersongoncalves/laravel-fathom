<?php

namespace JeffersonGoncalves\Fathom\Settings;

use Spatie\LaravelSettings\Settings;

class FathomSettings extends Settings
{
    public ?string $website_id;

    public bool $canonical;

    public bool $auto;

    public ?string $spa;

    public ?bool $honor_dnt;

    public static function group(): string
    {
        return 'fathom';
    }
}
