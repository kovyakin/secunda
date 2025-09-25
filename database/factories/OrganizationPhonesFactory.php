<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationPhones>
 */
class OrganizationPhonesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => $this->faker->numberBetween(1, 50),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
