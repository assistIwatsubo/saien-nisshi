<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Crop;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RidgeDetail>
 */
class RidgeDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ridge_id' => null,
            'crop_id'=> Crop::inRandomOrder()->first()->id,
            'ratio' => 100,
            'position' => null,
        ];
    }
}
