<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records
        Report::truncate();

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
