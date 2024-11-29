<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records
        Setting::truncate();

        // Seed new data
        Setting::create([
            'app_name' => 'Pathalogy',
            'email' => 'pathalogy@gmail.com',
            'whatsapp' => '+91 7318399177',
            'contact' => '+91 7318399177',
            'address' => 'Address',
            'header_image' => "assets/front/img/GCKC-footerlogo.png",
            'is_fresh' => 1,
        ]);
    }
}
