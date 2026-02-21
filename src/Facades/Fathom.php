<?php

namespace JeffersonGoncalves\Fathom\Facades;

use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\Fathom\Settings\FathomSettings;

/**
 * @see \JeffersonGoncalves\Fathom\Settings\FathomSettings
 */
class Fathom extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FathomSettings::class;
    }
}
