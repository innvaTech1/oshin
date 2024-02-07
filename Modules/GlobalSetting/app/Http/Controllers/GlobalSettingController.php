<?php

namespace Modules\GlobalSetting\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Modules\GlobalSetting\app\Models\CustomCode;
use Modules\GlobalSetting\app\Models\CustomPagination;
use Modules\GlobalSetting\app\Models\SeoSetting;
use Modules\GlobalSetting\app\Models\Setting;

class GlobalSettingController extends Controller {

    public function general_setting() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        $custom_paginations = CustomPagination::all();
        return view( 'globalsetting::setting', compact( 'custom_paginations' ) );
    }

    public function update_general_setting( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request_value = $request->validate( [
            'app_name' => 'required',
            'timezone' => 'required',
        ], [
            'app_name' => trans( 'App name is required' ),
            'timezone' => trans( 'Timezone is required' ),
        ] );

        Setting::where( 'key', 'app_name' )->update( ['value' => $request->app_name] );
        Setting::where( 'key', 'timezone' )->update( ['value' => $request->timezone] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );
    }

    public function update_logo_favicon( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $logo_setting = Setting::where( 'key', 'logo' )->first();

        if ( $request->file( 'logo' ) ) {
            $file_name = file_upload( $request->logo, $logo_setting->value, 'uploads/website-images/' );
            $logo_setting->value = $file_name;
            $logo_setting->save();
        }

        $favicon_setting = Setting::where( 'key', 'favicon' )->first();

        if ( $request->file( 'favicon' ) ) {
            $file_name = file_upload( $request->favicon, $favicon_setting->value, 'uploads/website-images/' );
            $favicon_setting->value = $file_name;
            $favicon_setting->save();
        }

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.general-setting', ['type' => 'logoAndFavicon'] )->with( $notification );
    }

    public function update_cookie_consent( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'cookie_status'    => 'required',
            'border'           => 'required',
            'corners'          => 'required',
            'background_color' => 'required',
            'text_color'       => 'required',
            'border_color'     => 'required',
            'btn_bg_color'     => 'required',
            'btn_text_color'   => 'required',
            'link_text'        => 'required',
            'btn_text'         => 'required',
            'message'          => 'required',
        ], [
            'cookie_status.required'    => trans( 'Status is required' ),
            'border.required'           => __( 'Border is required' ),
            'corners.required'          => __( 'Corner is required' ),
            'background_color.required' => __( 'Background color is required' ),
            'text_color.required'       => __( 'Text color is required' ),
            'border_color.required'     => __( 'Border Color is required' ),
            'btn_bg_color.required'     => __( 'Button color is required' ),
            'btn_text_color.required'   => __( 'Button text color is required' ),
            'link_text.required'        => __( 'Link text is required' ),
            'btn_text.required'         => __( 'Button text is required' ),
            'message.required'          => __( 'Message is required' ),
        ] );

        Setting::where( 'key', 'cookie_status' )->update( ['value' => $request->cookie_status] );
        Setting::where( 'key', 'border' )->update( ['value' => $request->border] );
        Setting::where( 'key', 'corners' )->update( ['value' => $request->corners] );
        Setting::where( 'key', 'background_color' )->update( ['value' => $request->background_color] );
        Setting::where( 'key', 'text_color' )->update( ['value' => $request->text_color] );
        Setting::where( 'key', 'border_color' )->update( ['value' => $request->border_color] );
        Setting::where( 'key', 'btn_bg_color' )->update( ['value' => $request->btn_bg_color] );
        Setting::where( 'key', 'btn_text_color' )->update( ['value' => $request->btn_text_color] );
        Setting::where( 'key', 'link_text' )->update( ['value' => $request->link_text] );
        Setting::where( 'key', 'btn_text' )->update( ['value' => $request->btn_text] );
        Setting::where( 'key', 'message' )->update( ['value' => $request->message] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.general-setting', ['type' => 'cookie_consent'] )->with( $notification );
    }

    public function update_custom_pagination( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        foreach ( $request->quantities as $index => $quantity ) {
            if ( $request->quantities[$index] == '' ) {
                $notification = array(
                    'messege'    => __( 'Every field are required' ),
                    'alert-type' => 'error',
                );

                return redirect()->back()->with( $notification );
            }

            $custom_pagination = CustomPagination::find( $request->ids[$index] );
            $custom_pagination->item_qty = $request->quantities[$index];
            $custom_pagination->save();
        }

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.general-setting', ['type' => 'custom_pagination'] )->with( $notification );

    }

    public function update_default_avatar( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $avatar_setting = Setting::where( 'key', 'default_avatar' )->first();

        if ( $request->file( 'default_avatar' ) ) {
            $file_name = file_upload( $request->default_avatar, $avatar_setting->value, 'uploads/website-images/' );
            $avatar_setting->value = $file_name;
            $avatar_setting->save();
        }

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.general-setting', ['type' => 'default_avatar'] )->with( $notification );

    }

    public function update_breadcrumb( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $breadcrumb_setting = Setting::where( 'key', 'breadcrumb_image' )->first();

        if ( $request->file( 'breadcrumb_image' ) ) {
            $file_name = file_upload( $request->breadcrumb_image, $breadcrumb_setting->value, 'uploads/website-images/' );
            $breadcrumb_setting->value = $file_name;
            $breadcrumb_setting->save();
        }

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.general-setting', ['type' => 'breadcrump_img'] )->with( $notification );
    }

    public function crediential_setting() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        return view( 'globalsetting::crediential' );
    }

    public function update_google_captcha( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'recaptcha_site_key'   => 'required',
            'recaptcha_secret_key' => 'required',
            'recaptcha_status'     => 'required',
        ], [
            'recaptcha_site_key.required'   => __( 'Site key is required' ),
            'recaptcha_secret_key.required' => __( 'Secret key is required' ),
            'recaptcha_status.required'     => trans( 'Status is required' ),
        ] );

        Setting::where( 'key', 'recaptcha_site_key' )->update( ['value' => $request->recaptcha_site_key] );
        Setting::where( 'key', 'recaptcha_secret_key' )->update( ['value' => $request->recaptcha_secret_key] );
        Setting::where( 'key', 'recaptcha_status' )->update( ['value' => $request->recaptcha_status] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.crediential-setting' )->with( $notification );
    }

    public function update_tawk_chat( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'tawk_status'    => 'required',
            'tawk_chat_link' => 'required',
        ], [
            'tawk_status.required'    => trans( 'Status is required' ),
            'tawk_chat_link.required' => __( 'Chat link is required' ),
        ] );

        Setting::where( 'key', 'tawk_status' )->update( ['value' => $request->tawk_status] );
        Setting::where( 'key', 'tawk_chat_link' )->update( ['value' => $request->tawk_chat_link] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.crediential-setting', ['type' => 'tawk_chat'] )->with( $notification );
    }

    public function update_google_analytic( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'google_analytic_status' => 'required',
            'google_analytic_id'     => 'required',
        ], [
            'google_analytic_status.required' => trans( 'Status is required' ),
            'google_analytic_id.required'     => __( 'Analytic id is required' ),
        ] );

        Setting::where( 'key', 'google_analytic_status' )->update( ['value' => $request->google_analytic_status] );
        Setting::where( 'key', 'google_analytic_id' )->update( ['value' => $request->google_analytic_id] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.crediential-setting', ['type' => 'google_analytic'] )->with( $notification );
    }

    public function update_facebook_pixel( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'pixel_status' => 'required',
            'pixel_app_id' => 'required',
        ], [
            'pixel_status.required' => trans( 'Status is required' ),
            'pixel_app_id.required' => __( 'App id is required' ),
        ] );

        Setting::where( 'key', 'pixel_status' )->update( ['value' => $request->pixel_status] );
        Setting::where( 'key', 'pixel_app_id' )->update( ['value' => $request->pixel_app_id] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.crediential-setting', ['type' => 'facebook_pixel'] )->with( $notification );
    }
    public function update_social_login( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $rules = [
            'facebook_login_status' => 'required',
            'facebook_app_id'       => 'required',
            'facebook_app_secret'   => 'required',
            'facebook_redirect_url' => 'required',
            'google_login_status'   => 'required',
            'gmail_client_id'       => 'required',
            'gmail_secret_id'       => 'required',
            'gmail_redirect_url'    => 'required',
        ];
        $customMessages = [
            'facebook_login_status.required' => trans( 'Facebook Status is required' ),
            'facebook_app_id.required'       => __( 'Facebook app id is required' ),
            'facebook_app_secret.required'   => trans( 'App secret is required' ),
            'facebook_redirect_url.required' => trans( 'Facebook redirect url is required' ),
            'google_login_status.required'   => trans( 'Google is required' ),
            'gmail_client_id.required'       => trans( 'Google client is required' ),
            'gmail_secret_id.required'       => trans( 'Google secret is required' ),
            'gmail_redirect_url.required'    => trans( 'Google redirect url is required' ),
        ];
        $request->validate( $rules, $customMessages );

        Setting::where( 'key', 'facebook_login_status' )->update( ['value' => $request->facebook_login_status] );
        Setting::where( 'key', 'facebook_app_id' )->update( ['value' => $request->facebook_app_id] );
        Setting::where( 'key', 'facebook_app_secret' )->update( ['value' => $request->facebook_app_secret] );
        Setting::where( 'key', 'facebook_redirect_url' )->update( ['value' => $request->facebook_redirect_url] );
        Setting::where( 'key', 'google_login_status' )->update( ['value' => $request->google_login_status] );
        Setting::where( 'key', 'gmail_client_id' )->update( ['value' => $request->gmail_client_id] );
        Setting::where( 'key', 'gmail_secret_id' )->update( ['value' => $request->gmail_secret_id] );
        Setting::where( 'key', 'gmail_redirect_url' )->update( ['value' => $request->gmail_redirect_url] );

        $this->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->route( 'admin.crediential-setting', ['type' => 'social_login'] )->with( $notification );

    }

    public function seo_setting() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        $pages = SeoSetting::all();

        return view( 'globalsetting::seo_setting', compact( 'pages' ) );
    }
    public function update_seo_setting( Request $request, $id ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $rules = [
            'seo_title'       => 'required',
            'seo_description' => 'required',
        ];
        $customMessages = [
            'seo_title.required'       => __( 'SEO title is required' ),
            'seo_description.required' => __( 'SEO description is required' ),
        ];
        $request->validate( $rules, $customMessages );

        $page = SeoSetting::find( $id );
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        $notification = __( 'Update Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );

    }

    public function cache_clear() {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        Artisan::call( 'optimize:clear' );

        $notification = __( 'Cache cleared successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );
    }

    public function database_clear() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        return view( 'globalsetting::database_clear' );
    }

    public function database_clear_success() {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        // truncate all model here

        $notification = __( 'Database Cleared Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );

    }

    public function put_setting_cache() {
        $setting_info = Setting::get();

        $setting = array();
        foreach ( $setting_info as $setting_item ) {
            $setting[$setting_item->key] = $setting_item->value;
        }

        $setting = (object) $setting;

        Cache::put( 'setting', $setting );
    }

    public function customCode() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        $customCode = CustomCode::first();
        if ( !$customCode ) {
            $customCode = new CustomCode();
            $customCode->css = '//write your css code here without the style tag';
            $customCode->javascript = '//write your javascript here without the script tag';
            $customCode->save();
        }
        return view( 'globalsetting::custom_code', compact( 'customCode' ) );
    }

    public function customCodeUpdate( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $customCode = CustomCode::first();
        if ( !$customCode ) {
            $customCode = new CustomCode();
        }
        $customCode->css = $request->css;
        $customCode->javascript = $request->javascript;
        $customCode->save();

        $notification = __( 'Updated Successfully' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );
    }
}
