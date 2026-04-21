<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DiaryDetailPesticide;
use App\Models\Pesticide;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiaryDetailPesticide>
 */
class DiaryDetailPesticideFactory extends Factory
{
    protected $model = DiaryDetailPesticide::class;

    public function definition()
    {
        return [
            'diary_detail_id' => null, // Seeder側で設定
            'crop_field_id' => null,
            'pesticide_id' => Pesticide::inRandomOrder()->first()?->id ?? 0,
            'concentration' => fake()->randomFloat(2, 0, 100),
            'concentration_unit' => fake()->randomElement(['%', '割']),
            'dilution_rate' => fake()->randomFloat(2, 0, 100),
            'amount' => fake()->randomFloat(2, 1, 1000),
            'amount_unit' => fake()->randomElement(['L', 'ml', 'g', 'kg']),
        ];
    }
}
