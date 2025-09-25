<?php

namespace Database\Factories;

use App\Models\Activities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activities>
 */
class ActivitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2,true),
            'parent_id' => null
        ];
    }

    public function withParent(Activities $parent): static
    {
        if (!Activities::query()->find($parent->id)) {
            $this->state(function () use ($parent) {
                return [
                    'parent_id' => null,
                ];
            });
        }

        return $this->state(function () use ($parent) {
            return [
                'parent_id' => $parent->id,
            ];
        });
    }
}
