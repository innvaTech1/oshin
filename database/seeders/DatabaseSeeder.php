<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Modules\BasicPayment\database\seeders\BasicPaymentInfoSeeder;
use Modules\Currency\database\seeders\CurrencySeeder;
use Modules\GlobalSetting\database\seeders\CustomPaginationSeeder;
use Modules\GlobalSetting\database\seeders\EmailTemplateSeeder;
use Modules\GlobalSetting\database\seeders\GlobalSettingInfoSeeder;
use Modules\GlobalSetting\database\seeders\SeoInfoSeeder;
use Modules\Installer\database\seeders\InstallerDatabaseSeeder;
use Modules\Language\database\seeders\LanguageSeeder;
use Modules\MenuBuilder\database\seeders\MenuBuilderDatabaseSeeder;
use Modules\PageBuilder\database\seeders\PageBuilderDatabaseSeeder;
use Modules\PaymentGateway\database\seeders\PaymentGatewaySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Cache::has('fresh_install') && Cache::get('fresh_install')) {
            $this->call([
                LanguageSeeder::class,
                CurrencySeeder::class,
                GlobalSettingInfoSeeder::class,
                BasicPaymentInfoSeeder::class,
                PaymentGatewaySeeder::class,
                CustomPaginationSeeder::class,
                EmailTemplateSeeder::class,
                SeoInfoSeeder::class,
                RolePermissionSeeder::class,
                AdminInfoSeeder::class,
                PageBuilderDatabaseSeeder::class,
                MenuBuilderDatabaseSeeder::class,
                InstallerDatabaseSeeder::class,
            ]);
        } else {
            $this->call([
                LanguageSeeder::class,
                CurrencySeeder::class,
                GlobalSettingInfoSeeder::class,
                BasicPaymentInfoSeeder::class,
                PaymentGatewaySeeder::class,
                CustomPaginationSeeder::class,
                EmailTemplateSeeder::class,
                SeoInfoSeeder::class,
                RolePermissionSeeder::class,
                AdminInfoSeeder::class,
                PageBuilderDatabaseSeeder::class,
                MenuBuilderDatabaseSeeder::class,
                InstallerDatabaseSeeder::class,
            ]);
        }

        // if(app()->isLocal()){
        //     $this->call([
        //     ]);
        // }

        // if(app()->isProduction()){
        //     $this->call([
        //     ]);
        // }
    }
}
