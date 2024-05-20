<?php

namespace Modules\Order\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\app\Models\Product;

class OrderReview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'seller_id',
        'rating',
        'comment',
        'status',
    ];

    protected $table = 'order_reviews';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'review_id');
    }
}
