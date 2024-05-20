<?php

namespace Modules\Order\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Order\Database\factories\ReviewImageFactory;

class ReviewImage extends Model
{
    use HasFactory;

    protected $table = 'review_images';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['review_id', 'image'];

    
    public function review()
    {
        return $this->belongsTo(OrderReview::class, 'review_id');
    }
}
