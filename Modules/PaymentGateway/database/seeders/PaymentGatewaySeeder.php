<?php

namespace Modules\PaymentGateway\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\PaymentGateway\app\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_info = [
            'razorpay_key' => 'rzp_test_cvrsy43xvBZfDT',
            'razorpay_secret' => 'c9AmI4C5vOfSWmZehhlns5df',
            'razorpay_name' => 'ecommerce',
            'razorpay_description' => 'This is test payment window',
            'razorpay_charge' => 0.00,
            'razorpay_theme_color' => '#6d0ce4',
            'razorpay_status' => 'active',
            'razorpay_currency_id' => MultiCurrency::where('currency_code', 'INR')->first()?->id,
            'razorpay_image' => 'uploads/website-images/razorpay.jpeg',
            'flutterwave_public_key' => 'FLWPUBK_TEST-6199046fedfadb3304d3726662040bf9-X',
            'flutterwave_secret_key' => 'FLWSECK_TEST-44d4064c7b4e7d3a278a8b8e206b465b-X',
            'flutterwave_app_name' => 'ecommerce',
            'flutterwave_charge' => 0.00,
            'flutterwave_currency_id' => MultiCurrency::where('currency_code', 'NGN')->first()?->id,
            'flutterwave_status' => 'active',
            'flutterwave_image' => 'uploads/website-images/flutterwave.jpg',
            'paystack_public_key' => 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38',
            'paystack_secret_key' => 'sk_test_77cb93329abbdc18104466e694c9f720a7d69c97',
            'paystack_status' => 'active',
            'paystack_charge' => 0.00,
            'paystack_image' => 'uploads/website-images/paystack.png',
            'paystack_currency_id' => MultiCurrency::where('currency_code', 'NGN')->first()?->id,
            'mollie_key' => 'test_PSkUJqktrsrnxjJnq4gnpfKjM722ms',
            'mollie_charge' => 0.00,
            'mollie_image' => 'uploads/website-images/mollie.png',
            'mollie_status' => 'active',
            'mollie_currency_id' => MultiCurrency::where('currency_code', 'CAD')->first()?->id,
            'instamojo_account_mode' => 'Sandbox',
            'instamojo_api_key' => 'test_ffc6f0ad486d6ae0ba9ca2f46da',
            'instamojo_auth_token' => 'test_ded356ba75e1aaa80bdd8f438d7',
            'instamojo_charge' => 0.00,
            'instamojo_image' => 'uploads/website-images/instamojo.png',
            'instamojo_currency_id' => MultiCurrency::where('currency_code', 'INR')->first()?->id,
            'instamojo_status' => 'active',
        ];

        foreach ($payment_info as $index => $payment_item) {
            $new_item = new PaymentGateway();
            $new_item->key = $index;
            $new_item->value = $payment_item;
            $new_item->save();
        }
    }
}
