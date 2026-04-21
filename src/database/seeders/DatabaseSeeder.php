<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Layout;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ModeSeeder::class,
            CropSeeder::class,
            PesticideSeeder::class,
            HelperCharacterSeeder::class,
            ScheduleStatusSeeder::class,
            FieldTypeSeeder::class,
            PrefectureSeeder::class,
            UserSeeder::class,
            ScheduleSeeder::class,
            DiarySeeder::class,
            FollowingSeeder::class,
            PlanSeeder::class,
            LayoutSeeder::class,
        ]);
    }
}
