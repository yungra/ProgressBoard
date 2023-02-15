<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            [
                'chat_room_id' => '1',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-15 13:40:11',
                'updated_at' => '2023-02-15 13:40:11',
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '0',
                'content' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
                'created_at' => '2023-02-15 16:50:32',
                'updated_at' => '2023-02-15 16:50:32',
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-15 16:56:58',
                'updated_at' => '2023-02-15 16:56:58',
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '0',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-15 16:57:22',
                'updated_at' => '2023-02-15 16:57:22',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-17 12:40:11',
                'updated_at' => '2023-02-17 12:40:11',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '0',
                'content' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
                'created_at' => '2023-02-17 13:50:53',
                'updated_at' => '2023-02-17 13:50:53',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-17 14:12:32',
                'updated_at' => '2023-02-17 14:12:32',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '0',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2023-02-17 16:20:25',
                'updated_at' => '2023-02-17 16:20:25',
            ],
        ]);
    }
}
