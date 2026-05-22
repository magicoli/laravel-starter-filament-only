<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\RendersMarkdownFile;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Home extends Page
{
    use RendersMarkdownFile;

    protected static string $routePath = "/";

    protected static bool $shouldRegisterNavigation = false;

    protected static string $markdownFile = "README.md";

    protected string $view = "filament.pages.markdown";

    protected static ?int $navigationSort = -1;

    protected static string|array $withoutRouteMiddleware = [
        Authenticate::class,
    ];

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return Filament::hasTopNavigation()
            ? null
            : "heroicon-o-information-circle";
    }
}
