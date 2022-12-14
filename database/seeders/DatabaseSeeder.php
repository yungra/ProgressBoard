<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            PrefectureSeeder::class,
            CitiesSeeder::class,
            SubjectsSeeder::class,
            TimetableSeeder::class,
            SchoolSeeder::class,
            StudentSeeder::class, // 開発用
            TeacherSeeder::class, // 開発用
            GuidanceReportSeeder::class, // 開発用
            ChatRoomSeeder::class, // 開発用
            MessageSeeder::class, // 開発用
            QuestionnaireSeeder::class, // 開発用
            NoticeSeeder::class, // 開発用
        ]);
    }
}
