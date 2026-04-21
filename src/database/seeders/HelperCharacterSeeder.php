<?php

namespace Database\Seeders;

use App\Models\HelperCharacter;
use Illuminate\Database\Seeder;

class HelperCharacterSeeder extends Seeder
{
    public function run(): void
    {
        $characters = [
            ['name' => 'テントウムシ', 'image_url' => 'helper_ladybird00.png', 'description' => 'ヒメカメノコテントウのオテントくん。熱血漢な性格で、いつもあなたを励まします。'],
            ['name' => 'ネコ', 'image_url' => 'helper_cat00.png', 'description' => 'ミケネコのヘルミャー。のんびりした性格です、あなたのことを見守っています。'],
        ];
        
        foreach ($characters as $character) {
            HelperCharacter::create($character);
        }
    }
}
