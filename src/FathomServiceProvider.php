<?php

namespace JeffersonGoncalves\Fathom;

use Illuminate\Support\Facades\Config;
use JeffersonGoncalves\Fathom\Settings\FathomSettings;
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

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        Config::set('settings.settings', array_merge(
            Config::get('settings.settings', []),
            [FathomSettings::class]
        ));
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $settingsMigrationsPath = __DIR__.'/../database/settings';

        Config::set('settings.migrations_paths', array_merge(
            Config::get('settings.migrations_paths', []),
            [$settingsMigrationsPath]
        ));

        $this->publishes([
            $settingsMigrationsPath => database_path('settings'),
        ], 'fathom-settings-migrations');
    }
}
