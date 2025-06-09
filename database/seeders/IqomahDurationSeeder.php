<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IqomahDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       \App\Models\IqomahDuration::insert([
        ['sholat' => 'subuh', 'duration' => 5],
        ['sholat' => 'dzuhur', 'duration' => 7],
        ['sholat' => 'ashar', 'duration' => 6],
        ['sholat' => 'maghrib', 'duration' => 3],
        ['sholat' => 'isya', 'duration' => 7],
        ]);
    }
}
