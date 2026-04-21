<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FieldType;

class FieldFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => null,
            'address' => fake('ja_JP')->optional()->address(),
            'field_type_id' => FieldType::inRandomOrder()->first()?->id ?? null,
            'memo' => fake('ja_JP')->optional()->realText(50),
        ];
    }
}
