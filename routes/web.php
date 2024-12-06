<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
// Tambahkan import ini
use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Auth::routes();

// Group semua route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Home Route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Customer Routes
    Route::resource('customers', CustomerController::class);

    // Film Routes
    Route::resource('films', FilmController::class);

    // Genre Routes
    Route::resource('genres', GenreController::class);

    // Rental Routes
    Route::resource('rentals', RentalController::class);
    Route::post('/rentals/{rental}/return', [RentalController::class, 'processReturn'])->name('rentals.return');
    Route::put('/rentals/{rental}/return', [RentalController::class, 'processReturn'])->name('rentals.return');

    // Sales Routes
    Route::resource('sales', SaleController::class);
    Route::get('sales/{sale}/print', [SaleController::class, 'print'])->name('sales.print');
    Route::put('/sales/{sale}/update-payment-status', [SaleController::class, 'updatePaymentStatus'])->name('sales.updatePaymentStatus');
});

// Tetap biarkan halaman login dan register terbuka
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
