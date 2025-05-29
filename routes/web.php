<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-specific dashboards
    //owner
    Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\OwnerController::class, 'dashboard'])->name('dashboard');

        // User management routes
        Route::resource('users', App\Http\Controllers\Owner\UserController::class);

    });

    //admin
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    });

    // pelanggan
    Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\PelangganController::class, 'dashboard'])->name('dashboard');
    });

    // vendor
    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\VendorController::class, 'dashboard'])->name('dashboard');
    });
require __DIR__.'/auth.php';