<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pendapatan/download/{id}', [PendapatanController::class, 'download'])->name('pendapatan.download');

    // PENDAPATAN
    Route::resource('pendapatan', PendapatanController::class);

    // BELANJA
    Route::resource('belanja', BelanjaController::class);
});



require __DIR__.'/auth.php';
