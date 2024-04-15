<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\Setting;

class GlobalSettingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting_data = [
            'app_name' => 'ecommerce',
            'version' => '1.00',
            'logo' => '',
            'timezone' => 'Asia/Dhaka',
            'favicon' => '',
            'cookie_status' => 'active',
            'border' => 'normal',
            'corners' => 'thin',
            'background_color' => '#184dec',
            'text_color' => '#fafafa',
            'border_color' => '#0a58d6',
            'btn_bg_color' => '#fffceb',
            'btn_text_color' => '#222758',
            'link_text' => 'More Info',
            'btn_text' => 'Yes',
            'message' => 'This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.',
            'copyright_text' => date('Y').' All rights reserved',
            'recaptcha_site_key' => '6LeQCfwjAAAoKX9eg',
            'recaptcha_secret_key' => '6LeQCfwjAMsR',
            'recaptcha_status' => 'inactive',
            'tawk_chat_link' => 'chat_link',
            'tawk_status' => 'active',
            'google_analytic_status' => 'active',
            'google_analytic_id' => 'google_analytic_id',
            'pixel_status' => 'inactive',
            'pixel_app_id' => 'pixel_app_id',
            'facebook_login_status' => 'active',
            'facebook_app_id' => 'facebook_app_id',
            'facebook_app_secret' => 'facebook_app_secret',
            'facebook_redirect_url' => 'facebook_redirect_url',
            'google_login_status' => 'inactive',
            'gmail_client_id' => 'gmail_client_id',
            'gmail_secret_id' => 'gmail_secret_id',
            'gmail_redirect_url' => 'gmail_redirect_url',
            'default_avatar' => 'uploads/website-images/default-avatar.png',
            'breadcrumb_image' => 'uploads/website-images/breadcrumb-image.jpg',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_sender_email' => 'sender@gmail.com',
            'mail_username' => '5205dacce6b',
            'mail_password' => '589852aa28',
            'mail_port' => '587',
            'mail_encryption' => 'ssl',
            'mail_sender_name' => 'ecommerce',
            'contact_message_receiver_mail' => 'receiver@gmail.com',
            'pusher_app_id' => 'pusher_app_id',
            'pusher_app_key' => 'pusher_app_key',
            'pusher_app_secret' => 'pusher_app_secret',
            'pusher_app_cluster' => 'pusher_app_cluster',
            'pusher_status' => 'active',
            'club_point_rate' => 1,
            'club_point_status' => 'active',
            'maintenance_mode' => 0,
            'last_update_date' => date('Y-m-d H:i:s'),
            'is_queable' => 'inactive',
        ];

        foreach ($setting_data as $index => $setting_item) {
            $new_item = new Setting();
            $new_item->key = $index;
            $new_item->value = $setting_item;
            $new_item->save();
        }
    }
}
