<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'img_path' => 'public/teacher1.png',
                'name' => 'teacher1',
                'email' => 'teacher1@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '38', //京都府右京区
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'img_path' => 'public/teacher2.png',
                'name' => 'teacher2',
                'email' => 'teacher2@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '1909', //鹿児島県中種子町
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'img_path' => 'public/teacher3.png',
                'name' => 'teacher3',
                'email' => 'teacher3@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '250',
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'img_path' => 'public/teacher4.png',
                'name' => 'teacher4',
                'email' => 'teacher4@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '350',
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'img_path' => 'public/teacher5.png',
                'name' => 'teacher5',
                'email' => 'teacher5@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '450',
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'img_path' => 'public/teacher6.png',
                'name' => 'teacher6',
                'email' => 'teacher6@test.com',
                'password' => Hash::make('password123'),
                'city_id' => '550',
                'university_id' => '2',
                'created_at' => '2022/10/10 10:10:10'
            ],
        ]);
    }
}
