<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FollowingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            $others = $users->where('id', '!=', $user->id)->random(15);

            foreach ($others as $target) {
                DB::table('followings')->updateOrInsert([
                    'user_id' => $user->id,
                    'following_id' => $target->id,
                ]);
            }
        }
    }
}
