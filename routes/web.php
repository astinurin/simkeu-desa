<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index']);

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // DOWNLOAD DOKUMEN
    Route::get('/pendapatan/download/{id}', [PendapatanController::class, 'download'])
        ->name('pendapatan.download');

    // PENDAPATAN
        // DETECT DOKUMEN
    Route::post('/pendapatan/detect', [PendapatanController::class, 'detect'])
        ->name('pendapatan.detect');

        // PENDAPATAN
    Route::resource('pendapatan', PendapatanController::class);

    // BELANJA
    Route::resource('belanja', BelanjaController::class);

    // =========================
    // SUPERADMIN ONLY
    // =========================
    Route::middleware('superadmin')->group(function () {

        // KELOLA USER
        Route::resource('users', UserController::class);
    });
});

require __DIR__ . '/auth.php';
