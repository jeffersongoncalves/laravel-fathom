<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('fathom.website_id', env('FATHOM_SITE'));
        $this->migrator->add('fathom.canonical', true);
        $this->migrator->add('fathom.auto', true);
        $this->migrator->add('fathom.spa', null);
        $this->migrator->add('fathom.honor_dnt', null);
    }
};
