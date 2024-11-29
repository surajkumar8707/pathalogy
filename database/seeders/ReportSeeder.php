<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET foreign_key_checks = 0');

        // Clear existing records
        Report::truncate();

        // Re-enable foreign key checks
        DB::statement('SET foreign_key_checks = 1');

        $report = Report::create([
            'category_id' => 1,
            'sub_category_id' => 1,
            'name' => 'Test User',
            'age' => 23,
            'refer_by_doctor' => 'Test Doctor',
        ]);

        // Attach the selected tests to the report
        $report->tests()->attach([
            1,2,3,4,5
        ]);

    }
}
