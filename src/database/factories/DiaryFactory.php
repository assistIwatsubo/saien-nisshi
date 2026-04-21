<?php

namespace Database\Factories;

use App\Models\Diary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiaryFactory extends Factory
{
    protected $model = Diary::class;

    public function definition()
    {
        return [
            'user_id' => null,
            'date' => null,
            'title' => fake('ja_JP')->optional()->realText(15),
            'summary' => fake('ja_JP')->optional()->realText(200),
        ];
    }
}
