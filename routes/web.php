<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\HelpdeskMonitoringController;
use App\Http\Controllers\DepartementController;

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

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // FITUR SCAN BARCODE
    Route::get('/inventories/scan', [InventoryController::class, 'scan'])->name('inventories.scan');
    Route::post('/inventories/scan', [InventoryController::class, 'scanSubmit'])->name('inventories.scanSubmit');
    Route::post('/inventories/check-barcode', [InventoryController::class, 'checkBarcode'])->name('inventories.checkBarcode');

    // CRUD INVENTORY
    Route::resource('inventories', InventoryController::class);
    Route::get('/inventories/{id}/download-barcode', [InventoryController::class, 'downloadBarcode'])->name('inventories.downloadBarcode');

    // LOG AKTIVITAS
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HELP DESK MONITORING (PAKAI RESOURCE SAJA)
    Route::resource('helpdesk', HelpdeskMonitoringController::class);
});


 // DEPARTEMENT DETAIL VIEW
Route::get('/departements/{id}', [App\Http\Controllers\DepartementController::class, 'show'])
    ->name('departements.show');


// =========================
//  AUTENTIKASI (BREEZE/JETSTREAM)
// =========================
require __DIR__.'/auth.php';
