# About this starter kit

This is a Laravel starter kit built around [Filament](https://filamentphp.com/) as the
primary UI layer — not just for admin, but for the entire application.

## What makes it different

Most Laravel starter kits (React, Vue, Svelte, Livewire/Flux) give you a frontend
foundation and leave authentication, roles, and admin as separate concerns to wire up
yourself. This kit takes a different position: **everything goes through Filament**, and
the plumbing is already connected.

## What's included

**Two-panel architecture**
A public-facing panel (top navigation, no auth required for public pages) and a protected
admin panel (sidebar), sharing configuration via a common trait. Adding a third panel is
one file and a few lines.

**Authentication**
[Laravel Fortify](https://laravel.com/docs/fortify) handles the backend — including
passkeys and two-factor authentication. Filament provides the only login screen. Fortify's
own views are disabled so users never land on a mismatched page.

**Role-based access control**
[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) is wired in with
five starter roles: `administrator`, `tenant`, `agent`, `talent`, `user`. Panel access is
declared in the PanelProvider via a small `AllowedRolesPlugin`, not scattered across the
User model. The seeder creates one fixture user per role.

**Markdown content pages**
A `RendersMarkdownFile` trait turns any Filament page into a rendered Markdown document.
A leading H1 is extracted and used as the Filament page title. Output is cached by file
modification time and invalidated automatically on change.

**Modern stack**
PHP 8.4, Laravel 13, Filament 5, Livewire 4, Tailwind CSS 4.

**Tests**
Smoke tests cover public page accessibility, panel access control, and role-based rejection.

## What it is not

This is not a SPA framework. There is no decoupled API, no client-side routing, no
JavaScript build complexity beyond Vite. If your project needs a rich client-side
frontend, one of the JS-based starter kits is a better fit.

## Typical use case

Multi-role applications where all users — administrators, clients, contributors — interact
through the same Filament-based interface, with different levels of access.
