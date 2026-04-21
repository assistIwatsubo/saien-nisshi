<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\ScheduleStatus;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        // ランダムな開始日と終了日
        $start = fake()->dateTimeBetween('-1 month', '+1 month');
        $end = fake()->boolean(70)
            ? Carbon::instance($start)->addDays(rand(0, 3))->toDateTime()
            : null;
            

        return [
            'user_id' => User::inRandomOrder()->first()->id, 
            'title' =>fake('ja_JP')->realText(15),
            'start' => $start,
            'end' => $end,
            'schedule_status_id' => ScheduleStatus::inRandomOrder()->first()->id, 
            'memo' => fake('ja_JP')->optional()->realText(200),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
