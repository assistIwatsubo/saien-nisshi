<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ridge>
 */
class RidgeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'layout_id' => null,
            'name' => fake('ja_JP')->streetAddress(),
            'size' => 90,
            'position' => null,
        ];
    }
}
