<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalSholatApiController extends Controller
{
    public function jadwal(Request $request)
    {
    $lokasi = 'Pasaman Barat';
    $city = $request->input('city', $lokasi);
    $country = $request->input('country', 'Indonesia');
    $method = $request->input('method', 20); // 20 = Moonsighting Committee Worldwide

    $url = "https://api.aladhan.com/v1/timingsByCity?city=$city&country=$country&method=$method";
    //https://api.aladhan.com/v1/timingsByCity?city=Pasaman%20Barat&country=Indonesia&method=20

    $response = Http::get($url);
    if (!$response->successful()) {
        return response()->json(['error' => 'Gagal ambil jadwal dari Aladhan'], 500);
    }

    $data = $response->json();

    $timings = $data['data']['timings'];

    return response()->json([
        ['nama' => 'Imsak', 'waktu' => $timings['Imsak'], 'iqomah' => 0],
        ['nama' => 'Subuh', 'waktu' => $timings['Fajr'], 'iqomah' => 5],
        ['nama' => 'Dzuhur', 'waktu' => $timings['Dhuhr'], 'iqomah' => 2],
        ['nama' => 'Ashar', 'waktu' => $timings['Asr'], 'iqomah' => 10],
        ['nama' => 'Maghrib', 'waktu' => $timings['Maghrib'], 'iqomah' => 5],
        ['nama' => 'Isya', 'waktu' => $timings['Isha'], 'iqomah' => 10],
    ]);
    }
}
