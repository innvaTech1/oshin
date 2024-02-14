<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ["name", "logo", "description", "link", "status", "featured", "meta_title", "meta_description", "sort_id", 'total_sale', 'avg_rating', "slug", "created_by", "updated_by",
    ];
    public static function boot()
    {
        parent::boot();

        static::created(function ($brand) {
            $brand->created_by = Auth::guard('admin')->user()->id ?? null;
        });

        static::updating(function ($brand) {
            $brand->updated_by = Auth::guard('admin')->user()->id ?? null;
        });
        self::created(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
        self::updated(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
        self::deleted(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    // public function sellerProductsAll()
    // {
    //     return SellerProduct::where('status', 1)->whereHas('product', function ($query) {
    //         return $query->where('brand_id', $this->id);
    //     })->activeSeller()->get();

    // }
    // public function sellerProducts()
    // {
    //     return $this->hasManyThrough(SellerProduct::class, Product::class)->activeSeller();
    // }
}
