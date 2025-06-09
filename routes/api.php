<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JadwalSholatApiController;
use App\Http\Controllers\WaktuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/iqomah-durations', function () {
    return \App\Models\IqomahDuration::pluck('duration', 'sholat');
});
Route::get('/jadwal-sholat', [JadwalSholatApiController::class, 'jadwal']);
Route::get('/waktu-ntp', [WaktuController::class, 'getWaktu']);
