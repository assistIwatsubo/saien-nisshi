<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Crop;
use App\Models\HelperCharacter;
use App\Models\Prefecture;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'nickname' => fake('ja_JP')->firstName,
            'favorite_crop_id' => Crop::inRandomOrder()->first()?->id,
            'helper_character_id' => HelperCharacter::inRandomOrder()->first()?->id,
            'prefecture_id' => Prefecture::inRandomOrder()->first()?->id,
            'image_url' => '/storage/avatars/sample-user-icon1.png',
        ];
    }
}
