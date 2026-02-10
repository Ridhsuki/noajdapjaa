<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partners')->insert([
            [
                'name' => 'PT Makkah Madinah Services',
                'phone' => '021-888111',
                'makkah_address' => 'Ajyad Street, Makkah',
                'makkah_phone' => '+96650000111',
                'madinah_address' => 'Markaziyah, Madinah',
                'madinah_phone' => '+96650000222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arabia Umrah Partner',
                'phone' => '021-777222',
                'makkah_address' => 'Misfalah Area, Makkah',
                'makkah_phone' => '+96650000333',
                'madinah_address' => 'Qurban Area, Madinah',
                'madinah_phone' => '+96650000444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
