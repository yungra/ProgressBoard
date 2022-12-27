<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaires')->insert([
            [
                'guidance_report_id' => '1',
                'comprehension' => '1',
                'speed' => '2',
                'satisfaction' => '3',
                'free' => 'aaaaaaaaaaa',
                'created_at' => '2022/10/10 10:10:10'
            ],
        ]);
    }
}
