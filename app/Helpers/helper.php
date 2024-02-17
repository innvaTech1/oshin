<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\Language\app\Models\Language;

function file_upload($request_file, $old_file, $file_path)
{
    $extention = $request_file->getClientOriginalExtension();
    $file_name = 'ecommerce-img' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
    $file_name = $file_path . $file_name;
    $request_file->move(public_path('uploads/' . $file_path), $file_name);

    if ($old_file) {
        if (File::exists(public_path($old_file))) {
            unlink(public_path($old_file));
        }

    }

    return $file_name;
}
if (!(function_exists('file_delete'))) {
    function file_delete($file_path)
    {
        if (File::exists(public_path($file_path))) {
            unlink(public_path($file_path));
        }
    }

}
// file upload method
if (!function_exists('allLanguages')) {
    function allLanguages()
    {
        return Language::all();
    }
}

if (!function_exists('getSessionLanguage')) {
    function getSessionLanguage(): string
    {
        if (!session()->has('lang')) {
            $lang = session()->put('lang', config('app.locale'));
            session()->forget('text_direction');
            session()->put('text_direction', 'ltr');
        }

        $lang = Session::get('lang');

        return $lang;
    }
}

function admin_lang()
{
    return Session::get('admin_lang');
}

// calculate currency
function currency($price)
{
    // currency information will be loaded by Session value

    // $currency_icon = Session::get('currency_icon');
    // $currency_code = Session::get('currency_code');
    // $currency_rate = Session::get('currency_rate');
    // $currency_position = Session::get('currency_position');

    $currency_icon = '$';
    $currency_code = 'USD';
    $currency_rate = '1.00';
    $currency_position = 'before_price';

    $price = $price * $currency_rate;
    $price = number_format($price, 2, '.', ',');

    if ($currency_position == 'before_price') {
        $price = $currency_icon . $price;
    } elseif ($currency_position == 'before_price_with_space') {
        $price = $currency_icon . ' ' . $price;
    } elseif ($currency_position == 'after_price') {
        $price = $price . $currency_icon;
    } elseif ($currency_position == 'after_price_with_space') {
        $price = $price . ' ' . $currency_icon;
    } else {
        $price = $currency_icon . $price;
    }

    return $price;
}

// calculate currency

// custom decode and encode input value
function html_decode($text)
{
    $after_decode = htmlspecialchars_decode($text, ENT_QUOTES);
    return $after_decode;
}

if (!function_exists('checkAdminHasPermission')) {
    function checkAdminHasPermission($permission): bool
    {
        return Auth::guard('admin')->user()->can($permission) ? true : false;
    }
}

if (!function_exists('slugCreate')) {
    function slugCreate($name, $lang_code = null)
    {
        if ($lang_code) {
            $slug = strtolower(str_replace(' ', '-', $name[$lang_code]));
        } else {
            $slug = strtolower(str_replace(' ', '-', $name));
        }
        return $slug;
    }
}
if (!function_exists('selling_price')) {
    function selling_price($amount = 0, $discount_type = 1, $discount_amount = 0)
    {
        $discount = 0;
        if ($discount_type == 0) {
            $discount = ($amount / 100) * $discount_amount;
        }if ($discount_type == 1) {
            $discount = $discount_amount;
        }
        $selling_price = $amount - $discount;
        return $selling_price;
    }
}
if (!function_exists('getDiscountAmount')) {
    function getDiscountAmount($amount = 0, $discount_type = 1, $discount_amount = 0)
    {
        $discount = 0;
        if ($discount_type == 0) {
            $discount = ($amount / 100) * $discount_amount;
        }if ($discount_type == 1) {
            $discount = $discount_amount;
        }
        return $discount;
    }
}
if (!function_exists('activeFileStorage')) {
    function activeFileStorage()
    {
        try {
            if (Cache::has('file_storage')) {
                $file_storage = Cache::get('file_storage');
                return $file_storage;
            } else {
                $row = Setting::where('key', 'file_storage')->where('value', 1)->first();
                if ($row) {
                    Cache::forget('file_storage');
                    Cache::rememberForever('file_storage', function () use ($row) {
                        return $row->type;
                    });
                    $file_storage = Cache::get('file_storage');
                    return $file_storage;
                } else {
                    return 'Local';
                }
            }
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('productSlug')) {
    function productSlug($str)
    {
        $str = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $str);
        $str = preg_replace("/[\/_|+ -]+/", '-', $str);
        return strtolower($str);
    }

}
