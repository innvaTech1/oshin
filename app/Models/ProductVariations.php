<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductVariations extends Model
{
    use HasFactory;
    protected $fillable = ["product_id", "product_sku_id", "attribute_id", "attribute_value_id", "created_by", "updated_by",
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->created_by = Auth::guard('admin')->user()->id ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::guard('admin')->user()->id ?? null;
        });
    }
}
