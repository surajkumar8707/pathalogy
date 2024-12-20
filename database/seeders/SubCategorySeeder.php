<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            [
                'category_id' => 1,
                'name' => 'CBC (Complete Blood Test)',
                'type' => 'number',
                'discount' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'Serology',
                'type' => 'percent',
                'discount' => 10,
            ],
        ];

        foreach($subcategories as $key => $subcategory){
            SubCategory::create($subcategory);
        }
    }
}
