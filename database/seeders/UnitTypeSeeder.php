<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productTypeLists = [
            'Kilogram',
            'Gram',
            'Litre',
            'Millilitre',
            'Piece',
            'Dozen',
            'Packet',
            'Box',
        ];

        foreach ($productTypeLists as $productTypeList) {
            UnitType::create([
                'name' => $productTypeList,
                'status' => 1,
            ]);
        }
    }
}
