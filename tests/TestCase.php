<?php

namespace JeffersonGoncalves\Fathom\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Fathom\FathomServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;
use Spatie\LaravelSettings\Migrations\SettingsMigrator;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->seedSettings();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelSettingsServiceProvider::class,
            FathomServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase(): void
    {
        Schema::create('settings', function (Blueprint $table): void {
            $table->id();
            $table->string('group');
            $table->string('name');
            $table->boolean('locked')->default(false);
            $table->json('payload');
            $table->timestamps();
            $table->unique(['group', 'name']);
        });
    }

    protected function seedSettings(): void
    {
        $migrator = app(SettingsMigrator::class);

        $migrator->add('fathom.website_id', config('fathom.defaults.website_id', config('fathom.website_id')));
        $migrator->add('fathom.canonical', config('fathom.defaults.canonical', config('fathom.canonical', true)));
        $migrator->add('fathom.auto', config('fathom.defaults.auto', config('fathom.auto', true)));
        $migrator->add('fathom.spa', config('fathom.defaults.spa', config('fathom.spa')));
        $migrator->add('fathom.honor_dnt', config('fathom.defaults.honor_dnt', config('fathom.honor_dnt')));
    }
}
