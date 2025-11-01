<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\HelpdeskMonitoringController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PPIRequestController;

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

    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // INVENTORY
    Route::get('/inventories/scan', [InventoryController::class, 'scan'])->name('inventories.scan');
    Route::post('/inventories/scan', [InventoryController::class, 'scanSubmit'])->name('inventories.scanSubmit');
    Route::post('/inventories/check-barcode', [InventoryController::class, 'checkBarcode'])->name('inventories.checkBarcode');
    Route::resource('inventories', InventoryController::class);
    Route::get('/inventories/{id}/download-barcode', [InventoryController::class, 'downloadBarcode'])->name('inventories.downloadBarcode');

    // LOG AKTIVITAS
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HELP DESK MONITORING
    Route::resource('helpdesk', HelpdeskMonitoringController::class);

    // PPI REQUEST & DEPARTEMENTS
    Route::resource('ppi', PPIRequestController::class);
    Route::resource('departements', DepartementController::class);

    // SURAT JALAN
    Route::resource('suratjalan', SuratJalanController::class);
});

// =========================
// DASHBOARD STAFF
// =========================
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');

    // Lihat tiket Helpdesk yang ditugaskan ke staff (PIC)
    Route::get('/staff/helpdesk', [StaffController::class, 'helpdesk'])->name('staff.helpdesk');

    // Update status tiket staff
    Route::put('/staff/helpdesk/{id}', [StaffController::class, 'updateHelpdesk'])->name('staff.helpdesk.update');
});

// =========================
//  AUTENTIKASI (BREEZE/JETSTREAM)
// =========================
require __DIR__.'/auth.php';
