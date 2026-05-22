<?php

namespace App\Providers\Filament;

use App\Filament\Plugins\AllowedRolesPlugin;
use App\Providers\Filament\Concerns\HasSharedPanelConfig;

use Filament\Enums\UserMenuPosition;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    use HasSharedPanelConfig;

    public function panel(Panel $panel): Panel
    {
        return $this->applySharedConfig($panel, "admin", "admin")
            ->plugins([
                AllowedRolesPlugin::make()->roles(["administrator", "tenant"]),
            ])
            ->topbar(false)
            ->pages([Dashboard::class])
            ->discoverResources(
                in: app_path("Filament/Admin/Resources"),
                for: "App\Filament\Admin\Resources",
            )
            ->discoverPages(
                in: app_path("Filament/Admin/Pages"),
                for: "App\Filament\Admin\Pages",
            )
            ->pages([Dashboard::class])
            ->userMenu(position: UserMenuPosition::Sidebar);
    }
}
