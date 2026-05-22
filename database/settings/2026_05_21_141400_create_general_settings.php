<?php

use App\Settings\GeneralSettings;

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(
            "general.site_name",
            GeneralSettings::defaults()["site_name"],
        );
    }
};
