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
                'name' => 'student1',
                'email' => 'student1@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'student2',
                'email' => 'student2@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '42', //京都府福知山市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'student3',
                'email' => 'student3@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'student4',
                'email' => 'student4@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'student5',
                'email' => 'student5@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'name' => 'student6',
                'email' => 'student6@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '7', //三重県名張市
                'school_id' => '1',
                'desired_school_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
        ]);
    }
}
