<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum (untuk user biasa)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route khusus admin dengan prefix & name
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Master: roles, users, menus
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('menus', MenuController::class); // ✅ Ditaruh langsung di sini
    });
});

// Auth routes (Laravel Breeze, Jetstream, dll)
require __DIR__.'/auth.php';
