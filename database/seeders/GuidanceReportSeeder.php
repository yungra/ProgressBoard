<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuidanceReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guidance_reports')->insert([
            [
                'student_id' => '1',
                'teacher_id' => '2',
                'timetable_id' => '2',
                'subject_id' => '3', //古文
                'report' => 'ああああああああ',
                // 'created_at' => '2022/10/10 10:10:10'
            ],
            
        ]);
    }
}
