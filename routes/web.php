<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IqomahDurationController;
use App\Http\Controllers\JadwalSholatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('depan');
});

Route::get('/iqomah', function () {
    return view('iqomah');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/admin/iqomah', IqomahDurationController::class)->only(['index', 'edit', 'update']);
    Route::get('/jadwal-sholat', [JadwalSholatController::class, 'index']);
    Route::get('/test', [JadwalSholatController::class, 'test']);
    Route::get('/tanggal', [JadwalSholatController::class, 'tanggal']);
});

require __DIR__.'/auth.php';
