<?php

namespace Database\Seeders;

use App\Models\ReportSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportSetting::truncate();

        ReportSetting::create([
            "address" => "Nala Pani Chowk, Sahastradhara Road, Adjoining Jagdamba Gas Agency, Dehra Dun - 248001",
            "working_hour" => "7:00 AM to 8:30 PM",
            "email" => "anubhavpathologylab@gmail.com",
            "phones" => "8650270860, 8077014570",
            "discount" => 0,
            "interpretation" => "In normal healthy individuals, CRP levels generally do not exceed 6 mg/L",
        ]);
    }
}
