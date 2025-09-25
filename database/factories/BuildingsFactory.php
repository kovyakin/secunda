<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BuildingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->country(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'house'=>fake()->numberBetween(1,100),
            'office'=>fake()->numberBetween(1,100),
            'lat' => fake()->latitude(),
            'lng' => fake()->longitude(),
        ];
    }
}
