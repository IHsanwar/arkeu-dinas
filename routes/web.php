<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use  App\Http\Controllers\AdminController;
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
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/new-user', [AdminController::class, 'addUser'])->name('add.user');
    Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
    Route::post('/laporan', [LaporanController::class,'store'])->name('laporan.store');
    Route::delete('/laporan/{id}', [LaporanController::class,'destroy'])->name('laporan.destroy');
    Route::get('/laporan/{id}/edit', [LaporanController::class,'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}', [LaporanController::class,'update'])->name('laporan.update');
    Route::get('/laporan/download', [LaporanController::class, 'download'])
        ->name('laporan.download');


    
});
// admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pengguna', [AdminController::class,'index'])->name('pengguna');
    Route::delete('/pengguna/{user}', [AdminController::class,'destroy'])->name('pengguna.destroy');
});
require __DIR__.'/auth.php';
