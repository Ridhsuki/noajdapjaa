<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PilgrimSeeder extends Seeder
{
    public function run(): void
    {
        $agents = DB::table('agents')->pluck('id');

        $pilgrims = [];

        foreach (range(1, 30) as $i) {
            $pilgrims[] = [
                'agent_id' => $agents->random(),
                'uuid' => (string) Str::uuid(),
                'name' => 'Jamaah ' . $i,
                'passport_number' => 'E' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'umrah_id' => 'UMR' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'hotel_madinah_name' => 'Hotel Madinah ' . rand(1, 5),
                'hotel_madinah_check_in' => now()->addDays(1),
                'hotel_madinah_check_out' => now()->addDays(4),
                'hotel_makkah_name' => 'Hotel Makkah ' . rand(1, 5),
                'hotel_makkah_check_in' => now()->addDays(5),
                'hotel_makkah_check_out' => now()->addDays(9),
                'photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pilgrims')->insert($pilgrims);
    }
}
