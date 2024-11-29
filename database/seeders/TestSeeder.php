<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'TCL',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'DLC',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'NEUTROPHIL',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'LYMPHOCYTE',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'EOSIN',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'MONOCYTE',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'BASOPHIL',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'REC',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'PCV',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'MCV',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'MCH',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'MCHC',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'RDW',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'PLATLET COUNT',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 2,
                'name' => 'CRP (Quantitative)',
                'upper_value' => number_format(rand(10,99),2),
                'percent' => rand(10,50),
            ],
        ];

        foreach($tests as $key => $test){
            Test::create($test);
        }
    }
}
