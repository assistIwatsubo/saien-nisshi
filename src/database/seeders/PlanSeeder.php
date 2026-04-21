<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Crop;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::with('fields')->get() as $user) {
            $crop = Crop::inRandomOrder()->first();
            foreach ($user->fields as $field) {
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
}
