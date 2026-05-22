<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

require __DIR__ . "/settings.php";

// Route::view("/", "welcome")->name("home");
// Route::get("/", App\Filament\Pages\Home::class)->name("home");

Route::middleware(["auth", "verified"])->group(function () {
    Route::view("dashboard", "dashboard")->name("dashboard");
});
