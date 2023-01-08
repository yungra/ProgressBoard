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
                'student_name' => 'student1',
                'teacher_id' => '2',
                'teacher_name' => 'teacher2',
                'timetable_id' => '2',
                'subject_id' => '3', //古文
                'report' => 'ああああああああ',
                'class_day' => '2022-02-10'
            ],
            [
                'student_id' => '1',
                'student_name' => 'student1',
                'teacher_id' => '3',
                'teacher_name' => 'teacher3',
                'timetable_id' => '4',
                'subject_id' => '2', //
                'report' => 'ああああああああ',
                'class_day' => '2022-02-10'
            ],
            [
                'student_id' => '1',
                'student_name' => 'student1',
                'teacher_id' => '2',
                'teacher_name' => 'teacher2',
                'timetable_name' => '2',
                'subject_id' => '3', //古文
                'report' => 'ああああああああ',
                'class_day' => '2022-02-10'
            ],
            [
                'student_id' => '1',
                'student_name' => 'student1',
                'teacher_id' => '2',
                'teacher_name' => 'teacher2',
                'timetable_id' => '2',
                'subject_id' => '3', //古文
                'report' => 'ああああああああ',
                'class_day' => '2022-02-10'
            ],
            [
                'student_id' => '2',
                'student_name' => 'student2',
                'teacher_id' => '3',
                'teacher_name' => 'teacher3',
                'timetable_id' => '4',
                'subject_id' => '7', //歴史
                'report' => 'いいいいいいいい',
                'class_day' => '2022-02-11'
            ],
            [
                'student_id' => '2',
                'student_name' => 'student2',
                'teacher_id' => '3',
                'teacher_name' => 'teacher3',
                'timetable_id' => '4',
                'subject_id' => '7', //歴史
                'report' => 'いいいいいいいい',
                'class_day' => '2022-02-11'
            ],
            [
                'student_id' => '2',
                'student_name' => 'student2',
                'teacher_id' => '3',
                'teacher_name' => 'teacher3',
                'timetable_id' => '4',
                'subject_id' => '7', //歴史
                'report' => 'いいいいいいいい',
                'class_day' => '2022-02-11'
            ],
            [
                'student_id' => '2',
                'student_name' => 'student2',
                'teacher_id' => '3',
                'teacher_name' => 'teacher3',
                'timetable_id' => '4',
                'subject_id' => '7', //歴史
                'report' => 'いいいいいいいい',
                'class_day' => '2022-02-11'
            ],
            [
                'student_id' => '3',
                'student_name' => 'student3',
                'teacher_id' => '2',
                'teacher_name' => 'teacher2',
                'timetable_id' => '2',
                'subject_id' => '3', //古文
                'report' => 'ああああああああ',
                'class_day' => '2022-02-13'
            ],

        ]);
    }
}
