<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '42', //京都府福知山市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],[
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
        ]);
    }
}
