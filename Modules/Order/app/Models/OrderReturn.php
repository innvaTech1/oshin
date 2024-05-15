<?php

namespace Modules\Order\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\factories\ProductReturnFactory;

class OrderReturn extends Model
{
    use HasFactory;

    protected $table = 'order_returns';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'status',
        'payment_status',
        'approved_at',
        'rejected_at',
        'canceled_at',
        'refunded_at',
    ];
}
