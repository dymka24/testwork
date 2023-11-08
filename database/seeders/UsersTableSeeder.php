<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert_data=[];
        while($i<20){
            $insert_data[]=['name'=>fake()->name,'email'=>fake()->email,'password'=>bcrypt(12345678)];
            $i++;
        }
        \DB::table('user_lists')->insert($insert_data);
    }
}
