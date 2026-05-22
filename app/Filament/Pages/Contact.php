<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Contact extends Page
{
    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-envelope";

    protected string $view = "filament.pages.contact";

    protected static string|array $withoutRouteMiddleware = [
        Authenticate::class,
    ];

    protected static ?int $navigationSort = 80;

    public static function getNavigationLabel(): string
    {
        return __("Contact");
    }

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return Filament::hasTopNavigation() ? null : self::$navigationIcon;
    }
}
