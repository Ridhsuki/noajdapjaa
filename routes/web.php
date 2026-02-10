<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ScanController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PilgrimController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

// ---------------------------
// Public Routes (Scan QR)
// ---------------------------
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/scan/{pilgrim}', [ScanController::class, 'show'])
        ->name('scan.show');
});

// ---------------------------
// Authenticated Routes
// ---------------------------
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('partners', PartnerController::class)->names('partners');
        Route::resource('agents', AgentController::class)->names('agents');
        Route::resource('pilgrims', PilgrimController::class)->names('pilgrims');
        Route::get('pilgrims/{pilgrim}/print', [PilgrimController::class, 'print'])
            ->name('pilgrims.print');
        Route::post('pilgrims/bulk-print', [PilgrimController::class, 'bulkPrint'])
            ->name('pilgrims.bulk-print');
    });
});

require __DIR__ . '/auth.php';
