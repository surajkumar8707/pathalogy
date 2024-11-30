<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            TestSeeder::class,
            ReportSeeder::class,
            SettingSeeder::class,
            ReportSettingSeeder::class,
            // ContactSeeder::class,
            // HomePageCarouselSeeder::class,
            // SocialMediaLinkSeeder::class,
            // RoomSeeder::class,
        ]);
    }
}
