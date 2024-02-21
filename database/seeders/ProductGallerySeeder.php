<?php

namespace Database\Seeders;

use App\Models\ProductGalaryImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate an array of available image numbers
        $availableImageNumbers = range(1, 16);

        // Loop through each product
        for ($productId = 1; $productId <= 10; $productId++) {
            // Shuffle the available image numbers
            shuffle($availableImageNumbers);

            // Select the first 4 shuffled image numbers
            $selectedImageNumbers = array_slice($availableImageNumbers, 0, 4);

            // Loop through the selected image numbers and create records
            foreach ($selectedImageNumbers as $imageNumber) {
                ProductGalaryImage::create([
                    'product_id' => $productId,
                    'images_source' => 'uploads/'.$imageNumber . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
