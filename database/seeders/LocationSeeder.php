<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Thana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = public_path('db_location.json');
        $locations = json_decode(file_get_contents($locations), true);


        $districts = $locations[0];
        $districts = $districts['data'];
        
        foreach ($districts as $district) {
            $district = [
                'id' => $district['id'],
                'division_id' => $district['division_id'],
                'name' => $district['name'],
                'bn_name' => $district['bn_name'],
                'latitude' => $district['lat'],
                'longitude' => $district['lng'],
                'website' => $district['website'],
                'status' => 1
            ];
            District::create($district);
        }
        $thanas = $locations[1];
        $thanas = $thanas['data'];
        
        foreach ($thanas as $thana) {
            $thana = [
                'id' => $thana['id'],
                'district_id' => $thana['district_id'],
                'name' => $thana['name'],
                'bn_name' => $thana['bn_name'],
                'latitude' => $thana['lat'],
                'longitude' => $thana['lng'],
                'status' => 1
            ];
            Thana::create($thana);
        }
    }
}
