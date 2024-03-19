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

class GlobalSettingController extends Controller
{
    protected $cachedSetting;

    public function __construct()
    {
        $this->cachedSetting = Cache::get('setting');
    }

    public function general_setting()
    {
        abort_unless(checkAdminHasPermission('setting.view'), 403);
        $custom_paginations = CustomPagination::all();

        return view('globalsetting::settings.index', compact('custom_paginations'));
    }

    public function update_general_setting(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);

        $request->validate([
            'app_name' => 'required',
            'timezone' => 'required',
            'is_queable' => 'required|in:active,inactive',
        ], [
            'app_name' => __('App name is required'),
            'timezone' => __('Timezone is required'),
            'is_queable' => __('Queue is required'),
            'is_queable.in' => __('Queue is invalid'),
        ]);

        Setting::where('key', 'app_name')->update(['value' => $request->app_name]);
        Setting::where('key', 'timezone')->update(['value' => $request->timezone]);
        Setting::where('key', 'is_queable')->update(['value' => $request->is_queable]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_logo_favicon(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);

        if ($request->file('logo')) {
            $file_name = file_upload($request->logo, $this->cachedSetting?->logo, 'uploads/custom-images/');
            Setting::where('key', 'logo')->update(['value' => $file_name]);
        }

        if ($request->file('favicon')) {
            $file_name = file_upload($request->favicon, $this->cachedSetting?->favicon, 'uploads/custom-images/');
            Setting::where('key', 'favicon')->update(['value' => $file_name]);
        }

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_cookie_consent(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'cookie_status' => 'required',
            'border' => 'required',
            'corners' => 'required',
            'background_color' => 'required',
            'text_color' => 'required',
            'border_color' => 'required',
            'btn_bg_color' => 'required',
            'btn_text_color' => 'required',
            'link_text' => 'required',
            'btn_text' => 'required',
            'message' => 'required',
        ], [
            'cookie_status.required' => __('Status is required'),
            'border.required' => __('Border is required'),
            'corners.required' => __('Corner is required'),
            'background_color.required' => __('Background color is required'),
            'text_color.required' => __('Text color is required'),
            'border_color.required' => __('Border Color is required'),
            'btn_bg_color.required' => __('Button color is required'),
            'btn_text_color.required' => __('Button text color is required'),
            'link_text.required' => __('Link text is required'),
            'btn_text.required' => __('Button text is required'),
            'message.required' => __('Message is required'),
        ]);

        Setting::where('key', 'cookie_status')->update(['value' => $request->cookie_status]);
        Setting::where('key', 'border')->update(['value' => $request->border]);
        Setting::where('key', 'corners')->update(['value' => $request->corners]);
        Setting::where('key', 'background_color')->update(['value' => $request->background_color]);
        Setting::where('key', 'text_color')->update(['value' => $request->text_color]);
        Setting::where('key', 'border_color')->update(['value' => $request->border_color]);
        Setting::where('key', 'btn_bg_color')->update(['value' => $request->btn_bg_color]);
        Setting::where('key', 'btn_text_color')->update(['value' => $request->btn_text_color]);
        Setting::where('key', 'link_text')->update(['value' => $request->link_text]);
        Setting::where('key', 'btn_text')->update(['value' => $request->btn_text]);
        Setting::where('key', 'message')->update(['value' => $request->message]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_custom_pagination(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        foreach ($request->quantities as $index => $quantity) {
            if ($request->quantities[$index] == '') {
                $notification = [
                    'messege' => __('Every field are required'),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            $custom_pagination = CustomPagination::find($request->ids[$index]);
            $custom_pagination->item_qty = $request->quantities[$index];
            $custom_pagination->save();
        }

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function update_default_avatar(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);

        if ($request->file('default_avatar')) {
            $file_name = file_upload($request->default_avatar, $this->cachedSetting?->default_avatar, 'uploads/custom-images/');
            Setting::where('key', 'default_avatar')->update(['value' => $file_name]);
        }

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function update_breadcrumb(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);

        if ($request->file('breadcrumb_image')) {
            $file_name = file_upload($request->breadcrumb_image, $this->cachedSetting?->breadcrumb_image, 'uploads/custom-images/');
            Setting::where('key', 'breadcrumb_image')->update(['value' => $file_name]);
        }

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_copyright_text(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'copyright_text' => 'required',
        ], [
            'copyright_text' => __('Copyright Text is required'),
        ]);
        Setting::where('key', 'copyright_text')->update(['value' => $request->copyright_text]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function crediential_setting()
    {
        abort_unless(checkAdminHasPermission('setting.view'), 403);

        return view('globalsetting::credientials.index');
    }

    public function update_google_captcha(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'recaptcha_site_key' => 'required',
            'recaptcha_secret_key' => 'required',
            'recaptcha_status' => 'required',
        ], [
            'recaptcha_site_key.required' => __('Site key is required'),
            'recaptcha_secret_key.required' => __('Secret key is required'),
            'recaptcha_status.required' => __('Status is required'),
        ]);

        Setting::where('key', 'recaptcha_site_key')->update(['value' => $request->recaptcha_site_key]);
        Setting::where('key', 'recaptcha_secret_key')->update(['value' => $request->recaptcha_secret_key]);
        Setting::where('key', 'recaptcha_status')->update(['value' => $request->recaptcha_status]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_tawk_chat(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'tawk_status' => 'required',
            'tawk_chat_link' => 'required',
        ], [
            'tawk_status.required' => __('Status is required'),
            'tawk_chat_link.required' => __('Chat link is required'),
        ]);

        Setting::where('key', 'tawk_status')->update(['value' => $request->tawk_status]);
        Setting::where('key', 'tawk_chat_link')->update(['value' => $request->tawk_chat_link]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_google_analytic(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'google_analytic_status' => 'required',
            'google_analytic_id' => 'required',
        ], [
            'google_analytic_status.required' => __('Status is required'),
            'google_analytic_id.required' => __('Analytic id is required'),
        ]);

        Setting::where('key', 'google_analytic_status')->update(['value' => $request->google_analytic_status]);
        Setting::where('key', 'google_analytic_id')->update(['value' => $request->google_analytic_id]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_facebook_pixel(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $request->validate([
            'pixel_status' => 'required',
            'pixel_app_id' => 'required',
        ], [
            'pixel_status.required' => __('Status is required'),
            'pixel_app_id.required' => __('App id is required'),
        ]);

        Setting::where('key', 'pixel_status')->update(['value' => $request->pixel_status]);
        Setting::where('key', 'pixel_app_id')->update(['value' => $request->pixel_app_id]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_social_login(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $rules = [
            'facebook_login_status' => 'required',
            'facebook_app_id' => 'required',
            'facebook_app_secret' => 'required',
            'facebook_redirect_url' => 'required',
            'google_login_status' => 'required',
            'gmail_client_id' => 'required',
            'gmail_secret_id' => 'required',
            'gmail_redirect_url' => 'required',
        ];
        $customMessages = [
            'facebook_login_status.required' => __('Facebook Status is required'),
            'facebook_app_id.required' => __('Facebook app id is required'),
            'facebook_app_secret.required' => __('App secret is required'),
            'facebook_redirect_url.required' => __('Facebook redirect url is required'),
            'google_login_status.required' => __('Google is required'),
            'gmail_client_id.required' => __('Google client is required'),
            'gmail_secret_id.required' => __('Google secret is required'),
            'gmail_redirect_url.required' => __('Google redirect url is required'),
        ];
        $request->validate($rules, $customMessages);

        Setting::where('key', 'facebook_login_status')->update(['value' => $request->facebook_login_status]);
        Setting::where('key', 'facebook_app_id')->update(['value' => $request->facebook_app_id]);
        Setting::where('key', 'facebook_app_secret')->update(['value' => $request->facebook_app_secret]);
        Setting::where('key', 'facebook_redirect_url')->update(['value' => $request->facebook_redirect_url]);
        Setting::where('key', 'google_login_status')->update(['value' => $request->google_login_status]);
        Setting::where('key', 'gmail_client_id')->update(['value' => $request->gmail_client_id]);
        Setting::where('key', 'gmail_secret_id')->update(['value' => $request->gmail_secret_id]);
        Setting::where('key', 'gmail_redirect_url')->update(['value' => $request->gmail_redirect_url]);

        $this->put_setting_cache();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function seo_setting()
    {
        abort_unless(checkAdminHasPermission('setting.view'), 403);
        $pages = SeoSetting::all();

        return view('globalsetting::seo_setting', compact('pages'));
    }

    public function update_seo_setting(Request $request, $id)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $rules = [
            'seo_title' => 'required',
            'seo_description' => 'required',
        ];
        $customMessages = [
            'seo_title.required' => __('SEO title is required'),
            'seo_description.required' => __('SEO description is required'),
        ];
        $request->validate($rules, $customMessages);

        $page = SeoSetting::find($id);
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function cache_clear()
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);

        return view('globalsetting::cache_clear');
    }

    public function cache_clear_confirm()
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        Artisan::call('optimize:clear');

        $notification = __('Cache cleared successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function database_clear()
    {
        abort_unless(checkAdminHasPermission('setting.view'), 403);

        return view('globalsetting::database_clear');
    }

    public function database_clear_success()
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        // truncate all model here

        $notification = __('Database Cleared Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function put_setting_cache()
    {
        $setting_info = Setting::get();

        $setting = [];
        foreach ($setting_info as $setting_item) {
            $setting[$setting_item->key] = $setting_item->value;
        }

        $setting = (object) $setting;

        Cache::put('setting', $setting);
    }

    public function customCode()
    {
        abort_unless(checkAdminHasPermission('setting.view'), 403);
        $customCode = CustomCode::first();
        if (! $customCode) {
            $customCode = new CustomCode();
            $customCode->css = '//write your css code here without the style tag';
            $customCode->javascript = '//write your javascript here without the script tag';
            $customCode->save();
        }

        return view('globalsetting::custom_code', compact('customCode'));
    }

    public function customCodeUpdate(Request $request)
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $customCode = CustomCode::first();
        if (! $customCode) {
            $customCode = new CustomCode();
        }
        $customCode->css = $request->css;
        $customCode->javascript = $request->javascript;
        $customCode->save();

        $notification = __('Updated Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_maintenance_mode()
    {
        abort_unless(checkAdminHasPermission('setting.update'), 403);
        $status = $this->cachedSetting?->maintenance_mode == 1 ? 0 : 1;

        Setting::where('key', 'maintenance_mode')->update(['value' => $status]);

        $this->put_setting_cache();

        return response()->json([
            'success' => true,
            'message' => __('Updated Successfully'),
        ]);
    }
}
