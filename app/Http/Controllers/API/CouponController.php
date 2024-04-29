<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Coupon\app\Models\Coupon;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->coupon == null) {
            $notification = trans('Coupon Field is required');
            return responseFail($notification, 403);
        }

        $coupon = Coupon::where(['coupon_code' => $request->coupon, 'status' => 'active'])->first();

        if ($coupon->expired_date < date('Y-m-d')) {
            $notification = trans('Coupon already expired');
            return responseFail($notification, 403);
        }

        if ($coupon->apply_qty >=  $coupon->max_quantity) {
            $notification = trans('Sorry! You can not apply this coupon');
            return responseFail($notification, 403);
        }
        if($coupon->min_price && $request->amount < $coupon->min_price){
            return responseFail('Minimum purchase amount should be '.$coupon->min_price,403);
        }



        if ($coupon) {
            $discount = 0;
            if ($coupon->offer_type == 1) {
                $coupon_price = $coupon->discount;
                $discountAmount = ($coupon_price / 100) * $request->amount;
                $discount = $discountAmount;
            } else {
                $discount = $coupon->discount;
            }

            return responseSuccess(['discount' => $discount, 'coupon' => $coupon]);

        } else {
            $notification = trans('Invalid Coupon');
            return responseFail($notification, 403);
        }
    }
}
