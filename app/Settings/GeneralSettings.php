<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public $site_name = "";

    public static function group(): string
    {
        return "general";
    }

    /**
     * @return array<string,mixed>
     */
    public static function defaults(): array
    {
        return [
            "site_name" => "W.R.A.P. App",
        ];
    }
}
