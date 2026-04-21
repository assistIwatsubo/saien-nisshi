<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CropField;
use App\Models\Crop;

class CropFieldFactory extends Factory
{
    protected $model = CropField::class;

    public function definition(): array
    {
        $crop = Crop::inRandomOrder()->first();

        return [
            'field_id' => null,
            'crop_id' => $crop->id,
        ];
    }
}
