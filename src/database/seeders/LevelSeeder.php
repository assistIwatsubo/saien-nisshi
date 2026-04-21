<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            // 家庭菜園モード
            [
                'mode_id' => 1, 'level' => 1, 'label' => '日記を1件投稿する',
                'benchmark' => json_encode(['target' => 'diaries', 'metric' => 'count', 'operator' => '>=', 'value' => 1])
            ],
            [
                'mode_id' => 1, 'level' => 2, 'label' => '連続10日以上、日記を投稿する',
                'benchmark' => json_encode(['target' => 'diaries', 'metric' => 'consecutive_days', 'operator' => '>=', 'value' => 10])
            ],
            [
                'mode_id' => 1, 'level' => 3, 'label' => '栽培を5つ以上登録する',
                'benchmark' => json_encode(['target' => 'crops', 'metric' => 'count', 'operator' => '>=', 'value' => 5])
            ],
            [
                'mode_id' => 1, 'level' => 4, 'label' => '栽培記録を10件以上、収穫まで完了させる',
                'benchmark' => json_encode(['target' => 'crops', 'metric' => 'harvested_count', 'operator' => '>=', 'value' => 10])
            ],
            [
                'mode_id' => 1, 'level' => 5, 'label' => '30日以上、家庭菜園モードを継続する',
                'benchmark' => json_encode(['target' => 'mode_user', 'metric' => 'duration_days', 'operator' => '>=', 'value' => 30])
            ],

            // 脱・家庭菜園モード
            [
                'mode_id' => 2, 'level' => 1, 'label' => '家庭菜園を卒業してプロの育成を始める',
                'benchmark' => json_encode(['target' => 'crops', 'metric' => 'professional_started', 'operator' => '=', 'value' => true])
            ],
            [
                'mode_id' => 2, 'level' => 2, 'label' => '育成した作物を販売した',
                'benchmark' => json_encode(['target' => 'sales', 'metric' => 'count', 'operator' => '>=', 'value' => 1])
            ],
            [
                'mode_id' => 2, 'level' => 3, 'label' => '3人以上のユーザーにフォローされる',
                'benchmark' => json_encode(['target' => 'followers', 'metric' => 'count', 'operator' => '>=', 'value' => 3])
            ],
            [
                'mode_id' => 2, 'level' => 4, 'label' => '脱・家庭菜園モードで30日以上継続する',
                'benchmark' => json_encode(['target' => 'mode_user', 'metric' => 'duration_days', 'operator' => '>=', 'value' => 30])
            ],
            [
                'mode_id' => 2, 'level' => 5, 'label' => '脱・家庭菜園モードで収穫した作物を10種類以上販売',
                'benchmark' => json_encode(['target' => 'sales', 'metric' => 'distinct_crops', 'operator' => '>=', 'value' => 10])
            ],
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
