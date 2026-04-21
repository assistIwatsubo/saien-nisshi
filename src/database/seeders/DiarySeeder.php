<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Diary;
use App\Models\DiaryDetail;
use App\Models\DiaryDetailCrop;
use App\Models\DiaryDetailPesticide;
use App\Models\Field;
use App\Models\CropField;
use App\Models\Crop;

class DiarySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $crops = Crop::all();

        foreach ($users as $user) {

            $dates = collect(range(1, 10))->map(function () { 
                return now()->startOfYear()->addDays(rand(0, now()->dayOfYear))->format('Y-m-d'); 
            })->unique();

            $fields = collect();
            foreach (range(1, 3) as $i) {
                $fields->push(
                    Field::factory()->create([
                        'user_id' => $user->id,
                        'name'    => "{$user->name}の畑{$i}",
                    ])
                );
            }

            foreach ($dates as $date) {
                $diary = Diary::factory()->for($user)->create(['date' => $date]);

                // DiaryDetail 作成
                $count = rand(2, 5);
                for ($i = 0; $i < $count; $i++) {
                    $detail = DiaryDetail::factory()->for($diary)->create([
                        'position' => $i + 1
                    ]);
                    

                    // ✅ 修正：そのユーザーの畑からランダムに選ぶ
                    $field = $fields->random();
                    $crop = $crops->random();

                    $cropField = CropField::firstOrCreate([
                        'crop_id' => $crop->id,
                        'field_id' => $field->id,
                    ]);

                    switch ($detail->type) {
                        case 'crop':
                            DiaryDetailCrop::create([
                                'diary_detail_id' => $detail->id,
                                'crop_field_id' => $cropField->id,
                            ]);
                            break;

                        case 'pesticide':
                            DiaryDetailPesticide::factory()->create([
                                'diary_detail_id' => $detail->id,'crop_field_id' => $cropField->id,
                            ]);
                            break;
                    }
                }
            }
        }
    }
}
