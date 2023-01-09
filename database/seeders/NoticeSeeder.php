<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->insert([
            [
                'is_student' => '1',
                'subject' => '夏期講習のお知らせ',
                'content' => 'aaaaaaaaaa',
                'created_at' => '2022/10/10 10:10:10'
            ],
            [
                'is_student' => '0',
                'subject' => 'テスト期間が始まります',
                'content' => 'bbbbbbbbbbb',
                'created_at' => '2022/10/10 10:10:10'
            ],
        ]);
    }
}
