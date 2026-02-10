<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Travel',
            'address' => $this->faker->address(),
            'logo' => null,
            'leader_name' => $this->faker->name(),
            'leader_number' => $this->faker->phoneNumber(),
            'muthowwif_name' => $this->faker->name('male'),
            'muthowwif_number' => $this->faker->phoneNumber(),
        ];
    }
}
