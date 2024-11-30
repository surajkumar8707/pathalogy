<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // Create a new report
        $report = Report::create([
            'category_id' => 1,
            'sub_category_id' => 1,
            'name' => 'Test User',
            'age' => 23,
            'refer_by_doctor' => 'Test Doctor',
        ]);

        // Attach the selected tests to the report with both category_id and sub_category_id
        $report->tests()->attach([
            1 => ['lower_value' => 1, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
            2 => ['lower_value' => 2, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
            3 => ['lower_value' => 3, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
            4 => ['lower_value' => 4, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
            5 => ['lower_value' => 5, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
            15 => ['lower_value' => 6, 'category_id' => $report->category_id, 'sub_category_id' => $report->sub_category_id],
        ]);
    }
}
