<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $totalProducts = 20; // Total number of products
        $totalCategories = 6; // Total number of categories
        $minProductsPerCategory = 1; // Minimum products per category
        $maxProductsPerCategory = 3; // Maximum products per category

        for ($categoryId = 1; $categoryId <= $totalCategories; $categoryId++) {
            $category = Category::find($categoryId);
            $productsCount = rand($minProductsPerCategory, $maxProductsPerCategory);
            $selectedProductIds = $this->getRandomProductIds($totalProducts, $productsCount);

            // Attach selected products to the category
            $category->products()->attach($selectedProductIds);
        }
    }

    private function getRandomProductIds($totalProducts, $count)
    {
        $productIds = range(1, $totalProducts);
        shuffle($productIds);
        return array_slice($productIds, 0, $count);
    }
}
