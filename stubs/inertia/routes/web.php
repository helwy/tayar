<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ThemeController;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware([ VerifyAdmin::class ])->group(function () {
        Route::get('/', [ DashboardController::class, 'index'])->name('home');
    });
});

Route::post('/update-locale/', [ LocaleController::class, 'update' ])->name('update-locale');
Route::post('/update-theme/', [ ThemeController::class, 'update' ])->name('update-theme');
