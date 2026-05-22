<?php

namespace App\Providers\Filament;

use App\Providers\Filament\Concerns\HasSharedPanelConfig;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;

class MainPanelProvider extends PanelProvider
{
    use HasSharedPanelConfig;

    public function panel(Panel $panel): Panel
    {
        return $this->applySharedConfig($panel, "main", "")
            ->default()
            ->login()
            ->topNavigation()
            ->discoverResources(
                in: app_path("Filament/Resources"),
                for: "App\Filament\Resources",
            )
            ->navigationItems([
                NavigationItem::make("Login")
                    ->icon("heroicon-o-lock-closed")
                    // ->url(route("filament.admin.auth.login"))
                    // ->url(route("admin.login"))
                    ->url("/admin/login")
                    ->sort(90)
                    ->visible(fn(): bool => !auth()->check()),
                NavigationItem::make("Admin")
                    ->icon("heroicon-o-squares-2x2")
                    // ->url(route("filament.admin.auth.login"))
                    // ->url(route("admin.login"))
                    ->url("/admin")
                    ->sort(90)
                    ->visible(
                        fn(): bool => auth()->check() &&
                            auth()
                                ->user()
                                ->hasAnyRole(["administrator", "tenant"]),
                    ),
            ])
            ->discoverPages(
                in: app_path("Filament/Pages"),
                for: "App\Filament\Pages",
            );
    }
}
