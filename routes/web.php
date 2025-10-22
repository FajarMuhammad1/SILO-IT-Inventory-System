<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityLogController;

// =========================
//  HALAMAN UTAMA
// =========================
Route::get('/', function () {
    return view('welcome');
});

// =========================
//  AUTH + VERIFICATION
// =========================
Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD (ambil dari InventoryController atau DashboardController, pilih salah satu)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // INVENTORY CRUD
    Route::resource('inventories', InventoryController::class);
    Route::resource('inventories', App\Http\Controllers\InventoryController::class);


    // FITUR SCAN BARCODE
    Route::get('/inventories/scan', [InventoryController::class, 'scan'])->name('inventories.scan');
    Route::post('/inventories/scan', [InventoryController::class, 'scanSubmit'])->name('inventories.scanSubmit');
    Route::get('/inventories/show-barcode/{barcode}', [InventoryController::class, 'showByBarcode'])->name('inventories.showByBarcode');

    // LOG AKTIVITAS (pakai controller beneran)
  Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');


    // PROFIL PENGGUNA
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
//  AUTENTIKASI (BREEZE/JETSTREAM)
// =========================
require __DIR__.'/auth.php';
