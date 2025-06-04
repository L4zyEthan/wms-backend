<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stores_Outlets>
 */
class Stores_OutletsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'address' => $this->faker->address(),
            'contact_number' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
