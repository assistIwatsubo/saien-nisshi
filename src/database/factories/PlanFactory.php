<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = ['播種', '収穫', '散布', '燻蒸'];

        return [
            'crop_id' => null,
            'field_id' => null,
            'year' => 2025,
            'month' => fake()->numberBetween(1, 12),
            'action' => fake()->randomElement($actions),
        ];
    }
}
