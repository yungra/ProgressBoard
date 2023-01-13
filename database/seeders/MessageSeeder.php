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
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '0',
                'content' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
            ],
            [
                'chat_room_id' => '1',
                'is_student' => '0',
                'content' => 'aaaaaaaaaa',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '0',
                'content' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '1',
                'content' => 'aaaaaaaaaa',
            ],
            [
                'chat_room_id' => '2',
                'is_student' => '0',
                'content' => 'aaaaaaaaaa',
            ],
        ]);
    }
}
