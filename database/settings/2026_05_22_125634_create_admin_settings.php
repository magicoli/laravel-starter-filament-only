<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use App\Settings\AdminSettings;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(
            "admin.site_name",
            AdminSettings::defaults()["site_name"],
        );
    }
};
