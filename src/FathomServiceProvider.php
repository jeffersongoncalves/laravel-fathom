<?php

namespace JeffersonGoncalves\Fathom;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FathomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-fathom')
            ->hasConfigFile('fathom')
            ->hasViews();
    }
}
