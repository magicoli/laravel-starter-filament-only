<?php

namespace App\Filament\Admin\Pages;

use BackedEnum;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends Page
{
    protected string $view = "filament.admin.pages.dashboard";

    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-squares-2x2";

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return Filament::hasTopNavigation() ? null : self::$navigationIcon;
    }

    public function getColumns(): int|array
    {
        return 4;
        // return [
        //     "md" => 4,
        //     "xl" => 5,
        // ];
    }
}
