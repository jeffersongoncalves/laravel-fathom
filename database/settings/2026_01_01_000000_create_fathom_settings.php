<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('fathom.website_id', config('fathom.defaults.website_id', config('fathom.website_id')));
        $this->migrator->add('fathom.canonical', config('fathom.defaults.canonical', config('fathom.canonical', true)));
        $this->migrator->add('fathom.auto', config('fathom.defaults.auto', config('fathom.auto', true)));
        $this->migrator->add('fathom.spa', config('fathom.defaults.spa', config('fathom.spa')));
        $this->migrator->add('fathom.honor_dnt', config('fathom.defaults.honor_dnt', config('fathom.honor_dnt')));
    }
};
