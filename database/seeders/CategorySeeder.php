<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fashion hierarchy categories
        $fashionCategories = [
            [
                'name' => 'Women\'s & Girls\' Fashion',
                'slug' => 'womens-and-girls-fashion',
                'parent_id' => 0,
                'depth_level' => 1,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-1.jpg',
            ],
            [
                'name' => 'Men\'s & Boys\' Fashion',
                'slug' => 'mens-and-boys-fashion',
                'parent_id' => 0,
                'depth_level' => 1,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-2.jpg',
            ],
            [
                'name' => 'Girls\' Fashion',
                'slug' => 'girsls-fashion',
                'parent_id' => 1,
                'depth_level' => 2,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-3.jpg',
            ],
            [
                'name' => 'Women\'s Fashion',
                'slug' => 'womens-fashion',
                'parent_id' => 1,
                'depth_level' => 2,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-4.jpg',
            ],
            [
                'name' => 'Boys\' Fashion',
                'slug' => 'boys-fashion',
                'parent_id' => 2,
                'depth_level' => 2,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-5.jpg',
            ],
            [
                'name' => 'Men\'s Fashion',
                'slug' => 'mens-fashion',
                'parent_id' => 2,
                'depth_level' => 2,
                'status' => 1,
                'searchable' => 1,
                'image' => 'backend/img/fashion/fashion-6.jpg',
            ],
        ];
        // Insert fashion categories
        foreach ($fashionCategories as $fashionCategory) {
            Category::create($fashionCategory);
        }
    }
}
