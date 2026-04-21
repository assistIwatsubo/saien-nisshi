<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Layout>
 */
class LayoutFactory extends Factory
{
    public function definition(): array
    {
        $directions = ['vertical', 'horizontal'];

        return [
            'field_id' => null,
            'title' => fake('ja_JP')->word(),
            'direction' => fake()->randomElement($directions),
            'gap' => 70,
            'year' => 2025,
            'memo' => fake('ja_JP')->optional()->realText(120),
        ];
    }
}
