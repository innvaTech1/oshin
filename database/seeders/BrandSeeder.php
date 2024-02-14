<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brands
        $brands = [
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-1.jpg',
            ],
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-2.jpg',
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-3.jpg',
            ],
            [
                'name' => 'Reebok',
                'slug' => 'reebok',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-4.jpg',
            ],
            [
                'name' => 'Under Armour',
                'slug' => 'under-armour',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-5.jpg',
            ],
            [
                'name' => 'Vans',
                'slug' => 'vans',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-6.jpg',
            ],
            [
                'name' => 'Converse',
                'slug' => 'converse',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-7.jpg',
            ],
            [
                'name' => 'New Balance',
                'slug' => 'new-balance',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-8.jpg',
            ],
            [
                'name' => 'Asics',
                'slug' => 'asics',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-9.jpg',
            ],
            [
                'name' => 'Skechers',
                'slug' => 'skechers',
                'status' => 1,
                'logo' => 'backend/img/brands/brand-10.jpg',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
