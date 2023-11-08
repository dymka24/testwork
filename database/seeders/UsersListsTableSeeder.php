<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert_data=[
            ['name'=>'crypto'],
        ];
        $i=0;
        while($i<12){
            $insert_data[]=['name'=>fake()->name];
            $i++;
        }
        \DB::table('user_lists')->insert($insert_data);
    }
}
