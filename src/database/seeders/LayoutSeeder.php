<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Layout;
use App\Models\Ridge;
use App\Models\RidgeDetail;

class LayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('fields')->get();

        foreach ($users as $user) {
            $field = $user->fields->random();
            $layout = Layout::factory()->create([
                'field_id' => $field->id,
            ]);
            $ridgeCount = random_int(3, 7);
            for ($i = 1; $i <= $ridgeCount; $i++) {
                $ridge = Ridge::factory()->create([
                    'layout_id' => $layout->id,
                    'position' => $i,
                ]);

                $detailCount = random_int(1, 3);
                $remaining = 100;

                for ($j = 1; $j <= $detailCount; $j++) {

                    if ($j === $detailCount) {
                        $ratio = $remaining;
                    } else {
                        $ratio = random_int(10, max(10, $remaining - 10 * ($detailCount - $j)));
                        $remaining -= $ratio;
                    }

                    RidgeDetail::factory()->create([
                        'ridge_id' => $ridge->id,
                        'position' => $j,
                        'ratio' => $ratio,
                    ]);
                }
            }
        }
        
    }
}
