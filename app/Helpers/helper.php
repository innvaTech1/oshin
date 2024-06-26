<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\Language\app\Models\Language;

function file_upload($request_file, $old_file, $file_path)
{
    $extention = $request_file->getClientOriginalExtension();
    $file_name = 'ecommerce-img' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
    $file_name = $file_path . $file_name;
    $request_file->move(public_path($file_path), $file_name);

    if ($old_file) {
        if (File::exists(public_path($old_file))) {
            unlink(public_path($old_file));
        }
    }

    return $file_name;
}
// file upload method
if (!function_exists('allLanguages')) {
    function allLanguages()
    {
        return Language::all();
    }
}
// all payment methods
if (!function_exists('allPaymentMethods')) {
    function allPaymentMethods($key = null)
    {
        $methods = [
            'bkash' => 'bKash',
            'rocket' => 'Rocket',
            'nagad' => 'Nagad',
            'bank_transfer' => 'Bank Transfer',
            'hand_cash' => 'Hand Cash',
            'cod' => 'Cash On Delivery',
            'check' => 'Bank Check',
        ];

        if ($key) {
            return $methods[$key];
        }

        return $methods;
    }
}

if (!function_exists('getSessionLanguage')) {
    function getSessionLanguage(): string
    {
        if (!session()->has('lang')) {
            session()->put('lang', config('app.locale'));
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
function currency($price = '')
{
    // currency information will be loaded by Session value

    $currencySetting = Cache::rememberForever('currency', function () {
        $siteCurrencyId = Session::get('site_currency');

        $currency = MultiCurrency::when($siteCurrencyId, function ($query) use ($siteCurrencyId) {
            return $query->where('id', $siteCurrencyId);
        })->when(!$siteCurrencyId, function ($query) {
            return $query->where('is_default', 'yes');
        })->first();

        return $currency;
    });

    $currency_icon = $currencySetting->currency_icon;
    $currency_code = $currencySetting->currency_code;
    $currency_rate = $currencySetting->currency_rate ? $currencySetting->currency_rate : 1;
    $currency_position = $currencySetting->currency_position;
    if ($price) {
        $price = floatval(str_replace(',', '', $price));
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
    } else {
        return $currency_icon . '0.00';
    }
}


// get currency icon
function currency_icon()
{
    $currencySetting = Cache::rememberForever('currency', function () {
        $siteCurrencyId = Session::get('site_currency');

        $currency = MultiCurrency::when($siteCurrencyId, function ($query) use ($siteCurrencyId) {
            return $query->where('id', $siteCurrencyId);
        })->when(!$siteCurrencyId, function ($query) {
            return $query->where('is_default', 'yes');
        })->first();

        return $currency;
    });

    return $currencySetting->currency_icon;
}

// remove currency icon using regular expression
function remove_icon($price)
{
    $price = preg_replace('/[^0-9,.]/', '', $price);

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

if (!function_exists('getSettingStatus')) {
    function getSettingStatus($key)
    {
        if (Cache::has('setting')) {
            $setting = Cache::get('setting');
            if (!is_null($key)) {
                return $setting->$key == 'active' ? true : false;
            }
        } else {
            try {
                return Setting::where('key', 'timezone')->first()?->value == 'active' ? true : false;
            } catch (Exception $e) {
                if (app()->isLocal()) {
                    Log::info($e->getMessage());
                }

                return false;
            }
        }

        return false;
    }
}

if (!function_exists('productSlug')) {
    function productSlug($slug)
    {
        return str_replace(' ', '-', $slug);
    }
}

// response with success message

if (!function_exists("responseSuccess")) {
    function responseSuccess($data = [], $message = 'success', $status = 200)
    {
        return response()->json([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }
}

// response with fail message

if (!function_exists("responseFail")) {
    function responseFail($message = 'fail', $status = 400)
    {
        return response()->json([
            'msg' => $message,
            'status' => $status,
        ]);
    }
}


// calculateDiscountPercentage

if (!function_exists('calculateDiscountPercentage')) {
    function calculateDiscountPercentage($originalPrice, $discountedPrice)
    {
        if ($originalPrice == 0) {
            return 0;
        }


        $discount = removeChar($originalPrice) - removeChar($discountedPrice);
        $discountPercentage = ($discount / removeChar($originalPrice)) * 100;

        return round($discountPercentage, 2);
    }
}


// remove special character from string

if (!function_exists('removeSpecialCharacter')) {
    function removeChar($string)
    {
        $val = floatval(str_replace(',', '', $string));

        return $val;
    }
}



if (!function_exists('getOrderStatus')) {
    function getOrderStatus($status)
    {
        switch ($status) {
            case 1:
                return 'Pending';
            case 2:
                return 'Accepted';
            case 3:
                return 'Progress';
            case 4:
                return 'On the way';
            case 5:
                return 'Delivered';
            case 6:
                return 'Cancelled';
            default:
                return 'Pending';
        }
    }
}

if (!function_exists('statusColor')) {
    function statusColor($status)
    {

        switch ($status) {
            case 1:
                return 'warning';
                break;
            case 2:
                return 'info';
                break;
            case 3:
                return 'info';
                break;
            case 4:
                return 'primary';
                break;
            case 5:
                return 'success';
                break;
            case 6:
                return 'danger';
                break;
            default:
                return 'warning';
        }
    }
}


// default avatar

if (!function_exists('avatar')) {
    function avatar($img = null)
    {
        $setting = cache('setting');
        if ($img && file_exists(public_path($img))) {
            return asset($img);
        } else {
            return asset($setting->default_avatar);
        }
    }
}