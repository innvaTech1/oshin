<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Coupon\app\Models\Coupon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        if ($request->coupon == null) {
            $notification = trans('user_validation.Coupon Field is required');
            return response()->json(['status' => 0, 'message' => $notification]);
        }

        $user = Auth::guard('api')->user();

        $coupon = Coupon::where(['code' => $request->coupon, 'status' => 1])->first();

        if ($coupon->expired_date < date('Y-m-d')) {
            $notification = trans('user_validation.Coupon already expired');
            return response()->json(['status' => 0, 'message' => $notification], 403);
        }

        if ($coupon->apply_qty >=  $coupon->max_quantity) {
            $notification = trans('user_validation.Sorry! You can not apply this coupon');
            return response()->json(['status' => 0, 'message' => $notification], 403);
        }

        if ($coupon) {
            if ($coupon->offer_type == 1) {
                $coupon_price = $coupon->offer_percentage;

                session()->put('offer_type', 1);
                session()->put('coupon_name', $request->coupon);

                $discountAmount = ($coupon_price / 100) * $sub_total;
                $discountAmount = number_format((float) $discountAmount, 2, '.', '');
                session()->put('coupon_price', $discountAmount);
            } else {
                $coupon_price = $coupon->discount;
            }

            return $this->cart();
        } else {
            $notification = trans('user_validation.Invalid Coupon');
            return response()->json(['status' => 0, 'message' => $notification], 403);
        }
    }
}
