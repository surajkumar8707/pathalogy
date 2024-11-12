<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pathalogy',
            ],
            [
                'name' => 'Radiology',
            ],
            [
                'name' => 'MicroBiology',
            ],
        ];

        foreach($categories as $key => $category){
            Category::create($category);
        }
    }
}
