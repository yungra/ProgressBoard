<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timetables')->insert([
            ['day' => '月', 'name'=> '1限'],
            ['day' => '月', 'name'=> '2限'],
            ['day' => '月', 'name'=> '3限'],
            ['day' => '月', 'name'=> '4限'],
            ]);
    }
}
