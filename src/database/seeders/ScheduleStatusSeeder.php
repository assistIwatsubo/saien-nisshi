<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScheduleStatus;

class ScheduleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleStatus::insert([
            ['name' => 'unused', ],
            ['name' => 'undone',],
            ['name' => 'done',],
        ]);
    }
}
