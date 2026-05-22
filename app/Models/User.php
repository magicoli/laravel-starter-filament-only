<?php

namespace App\Models;

use App\Filament\Plugins\AllowedRolesPlugin;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(["name", "email", "password"])]
#[
    Hidden([
        "password",
        "two_factor_secret",
        "two_factor_recovery_codes",
        "remember_token",
    ]),
]
class User extends Authenticatable implements FilamentUser, PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory,
        HasRoles,
        Notifiable,
        PasskeyAuthenticatable,
        TwoFactorAuthenticatable;

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->hasPlugin(AllowedRolesPlugin::ID)) {
            return $this->hasAnyRole(
                $panel->getPlugin(AllowedRolesPlugin::ID)->getRoles(),
            );
        }

        return true;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(" ")
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode("");
    }

    /**
     * Check if user is admin.
     *
     * TODO: fix $this->is_admin or implement true roles
     */
    public function isAdmin(): bool
    {
        return $this->hasRole("administrator");
    }
}
