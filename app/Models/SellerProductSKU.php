<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SellerProductSKU extends Model
{
    use HasFactory;
    protected $table = 'seller_product_s_k_u_s';
    protected $fillable = ['user_id', 'product_id', 'product_sku_id', 'product_stock', 'purchase_price', 'selling_price', 'status',
    ];

    public static function boot()
    {
        parent::boot();

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

    public function product()
    {
        return $this->belongsTo(SellerProduct::class, 'product_id', 'id');
    }

    public function mainProduct()
    {
        return $this->belongsToThrough(Product::class, SellerProduct::class,
            null,
            '',
            [SellerProduct::class => 'product_id']
        );
    }
    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public function product_variations()
    {
        return $this->hasMany(ProductVariations::class, 'product_sku_id', 'product_sku_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cartProducts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id')->where('product');
    }

    public function wholeSalePrices()
    {
        return $this->hasMany(WholesalePrice::class, 'sku_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(SellerProduct::class, 'product_id', 'id');
    }
    public function mainProducts()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function getSellPriceAttribute()
    {
        if (app('general_setting')->price_with_vat) {
            return $this->attributes['selling_price'] + ($this->product->tax ?? 0);
        } else {
            return $this->attributes['selling_price'];
        }
    }
}
