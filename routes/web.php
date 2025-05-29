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
        
        //paket
        Route::resource('pakets', \App\Http\Controllers\Admin\PaketController::class);
        //galeri
        Route::resource('galeris', \App\Http\Controllers\Admin\GaleriController::class);

        //vendor
        Route::patch('/orders/{order}/vendor-services/{jasa}', [App\Http\Controllers\Admin\OrderController::class, 'updateVendorStatus'])->name('orders.update-vendor-status');
        // Order management routes
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
 });

    // pelanggan
    Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\PelangganController::class, 'dashboard'])->name('dashboard');
     
        // Package routes
     Route::get('/pakets', [App\Http\Controllers\Pelanggan\PaketController::class, 'index'])->name('pakets.index');
     Route::get('/pakets/{paket}', [App\Http\Controllers\Pelanggan\PaketController::class, 'show'])->name('pakets.show');
     Route::post('/pakets/{paket}/book', [App\Http\Controllers\Pelanggan\PaketController::class, 'book'])->name('pakets.book');
     
     // Orders routes
     Route::get('/orders', [App\Http\Controllers\Pelanggan\PaketController::class, 'orders'])->name('orders.index');
     Route::get('/orders/{order}', [App\Http\Controllers\Pelanggan\PaketController::class, 'orderDetail'])->name('orders.show');
    
     // Vendor services routes
    Route::get('/vendors', [App\Http\Controllers\Pelanggan\VendorController::class, 'index'])->name('vendors.index');
    Route::get('/vendors/{jasa}', [App\Http\Controllers\Pelanggan\VendorController::class, 'show'])->name('vendors.show');
    Route::post('/vendors/add-to-order', [App\Http\Controllers\Pelanggan\VendorController::class, 'addToOrder'])->name('vendors.add-to-order');
    Route::get('/vendor-bookings', [App\Http\Controllers\Pelanggan\VendorController::class, 'bookings'])->name('vendors.bookings');
    });

    // vendor
    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        // Dashboard route you already have
        Route::get('/dashboard', [App\Http\Controllers\VendorController::class, 'dashboard'])->name('dashboard');
        
        //jasa
        Route::resource('jasas', \App\Http\Controllers\Vendor\JasaController::class);

        // Order routes
        Route::get('/bookings', [App\Http\Controllers\Vendor\OrderController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{jasa}/{order}', [App\Http\Controllers\Vendor\OrderController::class, 'show'])->name('bookings.show');
        });
        
require __DIR__.'/auth.php';