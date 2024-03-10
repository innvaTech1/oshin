<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\SeoSetting;

class SeoInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item1 = new SeoSetting();
        $item1->page_name = 'Home Page';
        $item1->seo_title = 'Home || ecommerce';
        $item1->seo_description = 'Home || ecommerce';
        $item1->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'About Page';
        $item2->seo_title = 'About || ecommerce';
        $item2->seo_description = 'About || ecommerce';
        $item2->save();
    }
}
