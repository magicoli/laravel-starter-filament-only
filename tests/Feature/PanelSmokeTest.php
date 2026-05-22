<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

// Main panel (public)

test("main panel home is publicly accessible", function () {
    $this->get(url("/"))->assertOk();
});

test("main panel about is publicly accessible", function () {
    $this->get(url("/about"))->assertOk();
});

test("main panel contact is publicly accessible", function () {
    $this->get(url("/contact"))->assertOk();
});

// Admin panel (protected)

test("admin panel redirects guests to filament login", function () {
    // Fortify's GET /login/login now redirects to Filament's /login
    $this->get(url("/admin"))->assertRedirect(url("/login/login"));
});

test("admin panel is accessible for administrators", function () {
    Role::create(["name" => "administrator", "guard_name" => "web"]);
    $admin = User::factory()->create();
    $admin->assignRole("administrator");

    $this->actingAs($admin)->get(url("/admin/dashboard"))->assertOk();
});

test("admin panel blocks users without admin role", function () {
    $this->actingAs(User::factory()->create())
        ->get(url("/admin"))
        ->assertForbidden();
});
