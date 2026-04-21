<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DiaryDetail;

class DiaryDetailFactory extends Factory
{
    protected $model = DiaryDetail::class;

    public function definition()
    {
        return [
            'diary_id' => null, 
            'type' => fake()->randomElement(['crop', 'pesticide', 'other']),
            'position' => null,
            'memo' => fake('ja_JP')->optional()->realText(24),
        ];
    }
}
