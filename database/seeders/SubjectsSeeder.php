<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            ['name' => '国語'],
            ['name' => '現代文'],
            ['name' => '古文'],
            ['name' => '漢文'],
            ['name' => '社会'],
            ['name' => '地理'],
            ['name' => '歴史'],
            ['name' => '世界史'],
            ['name' => '日本史'],
            ['name' => '倫理'],
            ['name' => '数学'],
            ['name' => '理科'],
            ['name' => '物理'],
            ['name' => '化学'],
            ['name' => '生物'],
            ['name' => '地学'],
            ['name' => '英語'],
            // ['id' => 1, 'name' => '国語'],
            // ['id' => 2, 'name' => '現代文'],
            // ['id' => 3, 'name' => '古文'],
            // ['id' => 4, 'name' => '漢文'],
            // ['id' => 5, 'name' => '社会'],
            // ['id' => 6, 'name' => '地理'],
            // ['id' => 7, 'name' => '歴史'],
            // ['id' => 8, 'name' => '世界史'],
            // ['id' => 9, 'name' => '日本史'],
            // ['id' => 10, 'name' => '倫理'],
            // ['id' => 11, 'name' => '数学'],
            // ['id' => 12, 'name' => '理科'],
            // ['id' => 13, 'name' => '物理'],
            // ['id' => 14, 'name' => '化学'],
            // ['id' => 15, 'name' => '生物'],
            // ['id' => 16, 'name' => '地学'],
            // ['id' => 17, 'name' => '英語'],
        ]);
    }
}
