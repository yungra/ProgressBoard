<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_rooms')->insert([
            [
                'id' => '1',
                'student_id' => '1',
                'teacher_id' => '2',
            ],
            [
                'id' => '2',
                'student_id' => '2',
                'teacher_id' => '1',
            ],
        ]);
    }
}
