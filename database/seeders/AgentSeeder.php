<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $partners = DB::table('partners')->pluck('id');

        DB::table('agents')->insert([
            [
                'partner_id' => $partners[0],
                'name' => 'Al-Firdaus Travel',
                'address' => 'Jakarta Selatan',
                'logo' => null,
                'leader_name' => 'Ahmad Fauzi',
                'leader_number' => '081234567890',
                'muthowwif_name' => 'Ust. Salman',
                'muthowwif_number' => '081298765432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'partner_id' => $partners[1],
                'name' => 'Barokah Umrah',
                'address' => 'Bandung',
                'logo' => null,
                'leader_name' => 'Ridwan Hidayat',
                'leader_number' => '081345678901',
                'muthowwif_name' => 'Ust. Hamzah',
                'muthowwif_number' => '081376543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
