<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\IqomahDuration;

class JadwalSholatController extends Controller
{
    public function index()
    {
        return view('jadwal');
    }

    public function api()
    {
        $kota = 1301; // ID kota API
        $tanggal = now()->format('yyyy-mm-dd');

        $res = Http::get("https://api.myquran.com/v2/sholat/jadwal/$kota/$tanggal");

        $data = $res->json()['data']['jadwal'];
        $durasi = IqomahDuration::pluck('duration', 'sholat');

        $result = collect(['subuh','dzuhur','ashar','maghrib','isya'])->map(function($nama) use ($data, $durasi) {
            return [
                'nama' => ucfirst($nama),
                'waktu' => $data[$nama],
                'iqomah' => $durasi[$nama] ?? 5
            ];
        });

        return response()->json($result);
    }
}
