<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SetoranController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\JenisSampahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard user biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
// Admin routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard & Riwayat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');

    // Nasabah
    Route::resource('nasabah', NasabahController::class);

    // Setoran (nested + standalone untuk create/edit)
    Route::resource('nasabah.setoran', SetoranController::class)->shallow();
    Route::resource('setoran', SetoranController::class);
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);

    // Jenis Sampah
    Route::resource('jenis-sampah', JenisSampahController::class);
});

// Profile routes (user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
