<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
// Route untuk halaman scan barcode
Route::get('/inventories/scan', [App\Http\Controllers\InventoryController::class, 'scan'])->name('inventories.scan');
// Route untuk menerima barcode hasil scan dan redirect
Route::post('/inventories/scan', [InventoryController::class, 'scanSubmit'])->name('inventories.scanSubmit');
// Route untuk scan barcode
Route::get('/inventories/show-barcode/{barcode}', [InventoryController::class, 'showByBarcode']);
Route::resource('inventories', InventoryController::class)->middleware('auth');
Route::get('/test-barcode', function() {
});










require __DIR__.'/auth.php';
