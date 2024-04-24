<?php

namespace Modules\Coupon\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Database\factories\CouponFactory;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'author_id',
        'coupon_code',
        'expired_date',
        'discount',
        'min_price',
        'offer_type',
        'max_quantity',
        'status',
    ];
}
