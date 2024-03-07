<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of brand IDs to choose from
        $brandIds = [1, 2, 3, 4,5,6];

        // Loop to create 10 random products
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'product_name' => 'Product ' . ($i + 2),
                'slug' => 'product-' . ($i + 2),
                'user_id' => 1, // Assuming the user ID
                'product_type' => rand(1, 2),
                'unit_type_id' => rand(1, 10), // Assuming unit type IDs exist
                'brand_id' => $brandIds[array_rand($brandIds)],
                'thumbnail_image_source' => 'uploads/' . (($i % 10) + 1) . '.jpg', // Assuming thumbnail images exist
                'barcode_type' => 'EAN-' . rand(100000000000, 999999999999),
                'model_number' => 'Model-' . ($i + 1),
                'shipping_type' => rand(1, 2),
                'shipping_cost' => rand(5, 20),
                'discount_type' => 'percentage', // Assuming discount type
                'discount' => rand(5, 15),
                'tax_type' => 'percentage', // Assuming tax type
                'tax' => rand(5, 20),
                'pdf' => null, // Assuming no PDF for now
                'video_provider' => null, // Assuming no video for now
                'video_link' => null, // Assuming no video for now
                'description' => 'Description for product ' . ($i + 1),
                'specification' => 'Specification for product ' . ($i + 1),
                'minimum_order_qty' => rand(1, 5),
                'min_sell_price' => rand(10, 50),
                'max_sell_price' => rand(50, 100),
                'total_sale' => rand(0, 100),
                'max_order_qty' => rand(5, 20),
                'meta_title' => 'Meta title for product ' . ($i + 1),
                'meta_description' => 'Meta description for product ' . ($i + 1),
                'meta_image' => 'meta-image-' . ($i + 1) . '.jpg', // Assuming meta images exist
                'is_physical' => rand(0, 1),
                'is_approved' => true,
                'status' => 1, // Assuming default status
                'display_in_details' => rand(0, 1),
                'requested_by' => null, // Assuming no requests for now
                'created_by' => 1, // Assuming the user ID
                'updated_by' => 1, // Assuming the user ID
                'stock_manage' => 'no', // Assuming stock management type
                'avg_rating' => rand(3, 5),
                'recent_view' => now()->subDays(rand(1, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
