<?php

namespace App\Filament\Admin\Pages;

use App\Settings\AdminSettings;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class AdminSettingsPage extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-adjustments-vertical";

    protected static string $settings = AdminSettings::class;

    public function getTitle(): string|Htmlable
    {
        return static::$title ?? __("Settings");
    }

    public static function getNavigationLabel(): string
    {
        return static::$title ?? __("Settings");
    }

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return Filament::hasTopNavigation() ? null : self::$navigationIcon;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            //
        ]);
    }
}
