<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserToUsersListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert_data = [];
        $users = User::all();
        $i = 1;
        while ($i < 10) {
            $users->each(function ($user) use (&$insert_data) {
                $insert_data[] = [
                    'user_id' => $user->id,
                    'user_list_id' => UserList::inRandomOrder()->first()->id
                ];
            });
            $i++;
        }
        \DB::table('user_users_list')->insert($insert_data);
    }
}
