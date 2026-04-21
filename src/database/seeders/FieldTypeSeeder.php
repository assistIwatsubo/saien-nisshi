<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTypeSeeder extends Seeder
{
    public function run()
    {
        $fieldTypes = [
            ['name' => '砂質土'],
            ['name' => '粘土質土'],
            ['name' => 'ローム土'],
            ['name' => '黒ボク土'],
            ['name' => '腐葉土'],
            ['name' => '軽石土'],
            ['name' => '水田土'],
            ['name' => '火山灰土'],
        ];

        DB::table('field_types')->insert($fieldTypes);
    }
}
