<?php

namespace App\Filament\Plugins;

use Filament\Contracts\Plugin;
use Filament\Panel;

/**
 * Panel plugin that declares which Spatie roles are allowed to access the panel.
 * Register in the PanelProvider; read in User::canAccessPanel().
 */
class AllowedRolesPlugin implements Plugin
{
    public const ID = "allowed-roles";

    protected array $roles = [];

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return self::ID;
    }

    public function roles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function register(Panel $panel): void {}

    public function boot(Panel $panel): void {}
}
