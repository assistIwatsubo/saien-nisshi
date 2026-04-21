<?php

namespace Database\Seeders;

use App\Models\Mode;
use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder
{
    public function run(): void
    {
        $modes = [
            ['mode' => 'beginner', 'label' => '家庭菜園モード'],
            ['mode' => 'pro', 'label' => '脱！　家庭菜園モード'],
        ];
         foreach ($modes as $mode) {
            Mode::create($mode);
        }
    }
}
