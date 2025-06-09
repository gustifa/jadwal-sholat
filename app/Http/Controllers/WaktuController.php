<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function getWaktu()
    {
        // Ambil waktu server (bisa diganti dengan waktu NTP)
        $serverTime = now();

        // Misalkan waktu Iqomah akan dimulai 60 detik dari waktu server
        $durasiMenujuIqomah = 60; // dalam detik

        return response()->json([
            'datetime' => $serverTime->toDateTimeString(),
            'timestamp' => $serverTime->timestamp,
            'durasi_menuju_iqomah' => $durasiMenujuIqomah
        ]);
    }
}
