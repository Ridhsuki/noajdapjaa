<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PilgrimFactory extends Factory
{
    public function definition(): array
    {
        $madinahCheckIn = fake()->boolean(70)
            ? fake()->dateTimeBetween('now', '+5 days')
            : null;

        $madinahCheckOut = $madinahCheckIn
            ? (clone $madinahCheckIn)->modify('+' . rand(1, 3) . ' days')
            : null;

        $makkahCheckIn = fake()->boolean(70)
            ? fake()->dateTimeBetween('+6 days', '+10 days')
            : null;

        $makkahCheckOut = $makkahCheckIn
            ? (clone $makkahCheckIn)->modify('+' . rand(2, 4) . ' days')
            : null;

        return [
            'agent_id' => Agent::factory(),
            'uuid' => (string) Str::uuid(),

            'name' => fake('id_ID')->name(),
            'passport_number' => 'E' . fake()->unique()->numerify('#######'),
            'umrah_id' => fake()->unique()->numerify('###########'),

            'hotel_madinah_name' => $madinahCheckIn ? fake()->city() . ' Hotel' : null,
            'hotel_madinah_check_in' => $madinahCheckIn?->format('Y-m-d'),
            'hotel_madinah_check_out' => $madinahCheckOut?->format('Y-m-d'),

            'hotel_makkah_name' => $makkahCheckIn ? fake()->city() . ' Hotel' : null,
            'hotel_makkah_check_in' => $makkahCheckIn?->format('Y-m-d'),
            'hotel_makkah_check_out' => $makkahCheckOut?->format('Y-m-d'),

            'photo_path' => null,
        ];
    }
}
