<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\ModeUser;
use App\Models\Field;
use App\Models\Crop;
use App\Models\Plan;



class UserSeeder extends Seeder
{
 public function run(): void
    {
        // Factoryでランダムなダミーユーザー10件作成
        User::factory(20)
            ->create()
            ->each(function ($user) { 
                Profile::factory()->create(['user_id' => $user->id,]);
                ModeUser::create([
                    'user_id' => $user->id,
                    'mode_id' => 1,
                    'started_at' => now(),
                ]);
            });

        // テスト用の固定ユーザーを追加
        $pro = User::create([
            'user_slug' => 'engawa-protaro',
            'name' => '縁側プロ太郎',
            'email' => 'pro@example.com',
            'password' => bcrypt('pass1234'),
        ]);

        Profile::factory()->create([
            'user_id' => $pro->id,
        ]);
        ModeUser::create([
            'user_id' => $pro->id,
            'mode_id' => 1,
            'started_at' => now()->subDays(40),
            'ended_at' => now()->subDays(10),
        ]);
        ModeUser::create([
            'user_id' => $pro->id,
            'mode_id' => 2,
            'started_at' => now()->subDays(10),
            'ended_at' => null,
        ]);

        $pro_fields = collect();
        foreach (range(1, 5) as $i) {
            $pro_fields->push(
                Field::factory()->create([
                    'user_id' => $pro->id,
                    'name'    => "{$pro->name}の畑{$i}（Plan用）",
                ])
            );
        };
        foreach ($pro_fields as $field) {
            $crop = Crop::inRandomOrder()->first();

            foreach (range(1, 12) as $month) {
                Plan::factory()->create([
                    'crop_id' => $crop->id,
                    'field_id' => $field->id,
                    'month' => $month,
                ]);
            }
        }


        $beginner = User::create([
            'user_slug' => 'engawa-beginnerjiro',
            'name' => '縁側ビギナー次郎',
            'email' => 'beginner@example.com',
            'password' => bcrypt('pass1234'),
        ]);

        Profile::factory()->create([
            'user_id' => $beginner->id,
        ]);
        ModeUser::create([
            'user_id' => $beginner->id,
            'mode_id' => 1,
            'started_at' => now(),
        ]);

        $beginner_fields = collect();
        foreach (range(1, 5) as $i) {
            $beginner_fields->push(
                Field::factory()->create([
                    'user_id' => $beginner->id,
                    'name'    => "{$beginner->name}の畑{$i}（Plan用）",
                ])
            );
        };
        foreach ($beginner_fields as $field) {
            $crop = Crop::inRandomOrder()->first();

            foreach (range(1, 12) as $month) {
                    Plan::factory()->create([
                    'crop_id' => $crop->id,
                    'field_id' => $field->id,
                    'month' => $month,
                ]);
            }
        }

    }
}
