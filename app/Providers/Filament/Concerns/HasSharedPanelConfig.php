<?php

namespace App\Providers\Filament\Concerns;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Panel\Concerns\HasRoutes;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

trait HasSharedPanelConfig
{
    protected function applySharedConfig(
        Panel $panel,
        string $id,
        string $path,
    ): Panel {
        return $panel
            ->id($id)
            ->path($path)
            ->colors(["primary" => Color::Amber])
            ->font(
                "Switzer",
                url: asset("assets/fonts/Switzer_Complete/css/switzer.css"),
                provider: LocalFontProvider::class,
            )
            ->brandLogo(fn() => Vite::asset(config("app.logo")))
            ->brandLogoHeight(
                fn() => request()->is("admin/login") ? "64px" : "32px",
            )
            ->homeUrl("/")
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->slug("profile")
                    ->shouldRegisterNavigation(false),
            ])
            ->userMenuItems([
                "profile" => MenuItem::make()
                    ->label(fn() => auth()->user()?->name ?? __("Profile"))
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon("heroicon-m-user-circle")
                    ->visible(fn(): bool => auth()->check()),
            ])
            ->widgets([AccountWidget::class, FilamentInfoWidget::class])
            ->unsavedChangesAlerts()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
