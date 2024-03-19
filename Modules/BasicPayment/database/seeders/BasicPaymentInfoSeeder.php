<?php

namespace Modules\BasicPayment\database\seeders;

use Illuminate\Database\Seeder;
use Modules\BasicPayment\app\Models\BasicPayment;
use Modules\Currency\app\Models\MultiCurrency;

class BasicPaymentInfoSeeder extends Seeder {
    public function run(): void {
        $basic_payment_info = [
            'stripe_key'          => 'pk_test_33mdngCLuLsmECXOe8mbde9f00pZGT4uu9',
            'stripe_secret'       => 'sk_test_MroTZzRZRv2KJ9Hmaro73SE800UOR90Q9u',
            'stripe_currency_id'  => MultiCurrency::where( 'currency_code', 'USD' )->first()?->id,
            'stripe_status'       => 'active',
            'stripe_charge'       => 0.00,
            'stripe_image'        => 'uploads/website-images/stripe.png',
            'paypal_client_id'    => 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy',
            'paypal_secret_key'   => 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn',
            'paypal_account_mode' => 'sandbox',
            'paypal_currency_id'  => MultiCurrency::where( 'currency_code', 'USD' )->first()?->id,
            'paypal_charge'       => 0.00,
            'paypal_status'       => 'active',
            'paypal_image'        => 'uploads/website-images/paypal.jpg',
            'bank_information'    => "Bank Name => Your bank name\r\nAccount Number =>  Your bank account number\r\nRouting Number => Your bank routing number\r\nBranch => Your bank branch name",
            'bank_status'         => 'active',
            'bank_image'          => 'uploads/website-images/bank-pay.png',
            'bank_charge'         => 0.00,
            'bank_currency_id'    => MultiCurrency::where( 'currency_code', 'USD' )->first()?->id,
        ];

        foreach ( $basic_payment_info as $index => $payment_item ) {
            $new_item = new BasicPayment();
            $new_item->key = $index;
            $new_item->value = $payment_item;
            $new_item->save();
        }
    }
}
