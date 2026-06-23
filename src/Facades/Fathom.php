<?php

namespace JeffersonGoncalves\Fathom\Facades;

use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

/**
 * @property ?string $website_id
 * @property bool $canonical
 * @property bool $auto
 * @property ?string $spa
 * @property ?bool $honor_dnt
 *
 * @see FathomSettings
 */
class Fathom extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FathomSettings::class;
    }
}
