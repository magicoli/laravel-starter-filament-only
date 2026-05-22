<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $domain = preg_replace("+.*://+", "", config("app.url", "example.com"));

        $roles = ["administrator", "tenant", "agent", "talent", "user"];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(["name" => $roleName, "guard_name" => "web"]);
        }

        foreach (
            [
                "administrator" => "Administrator D",
                "tenant" => "Tenant E",
                "agent" => "Agent G",
                "talent" => "Talent A",
                "user" => "User",
            ]
            as $role => $name
        ) {
            $user = User::firstOrCreate(
                ["email" => "{$role}@{$domain}"],
                [
                    "name" => $name,
                    "password" => bcrypt("changeme"),
                ],
            );
            $user->syncRoles([$role]);
        }
    }
}
