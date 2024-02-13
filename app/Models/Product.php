<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["product_name", "sku", "slug", 'user_id', "product_type", "unit_type_id", "brand_id", "thumbnail_image_source", "barcode_type", "model_number", "shipping_type", "shipping_cost", "discount_type", "discount", "tax_type", "tax", "pdf", "video_provider", "video_link", "description", 'specification', "minimum_order_qty", 'min_sell_price', 'max_sell_price', 'total_sale', "max_order_qty", "meta_title", "meta_description", "meta_image", 'is_physical', 'is_approved', 'status', 'display_in_details', 'requested_by', "created_by", "updated_by", 'stock_manage', 'avg_rating', 'recent_view',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if ($model->created_by == null) {
                $model->created_by = Auth::guard('admin')->user()->id ?? null;
            }
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::guard('admin')->user()->id ?? null;
        });
        self::creating(function ($model) {
            $model->slug = $model->createSlug($model->product_name);
        });
        self::created(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
        self::updating(function ($model) {
            $model->slug = $model->createSlug($model->product_name, $model->id);
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
    public function unit_type()
    {
        return $this->belongsTo(UnitType::class)->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id', 'product_id');
    }
    private function createSlug($name, $model = null)
    {
        $str_slug = strtolower(str_replace(" ", "-", $name));
        return $this->abalivaslug($str_slug, 0, $model);
    }
    private function abalivaslug($slug, $count = 0, $model = null)
    {
        if ($count) {
            $newslug = $slug . '-' . $count;
        } else {
            $newslug = $slug;
        }
        if (static::whereSlug($newslug)->where('id', '!=', $model)->first()) {
            return $this->abalivaslug($slug, $count + 1, $model);
        }
        return $newslug;
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id")->withDefault();
    }
    public function variations()
    {
        return $this->hasMany(ProductVariations::class);
    }
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
    public function activeSkus()
    {

        return $this->hasMany(ProductSku::class)->where('status', 1);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('tag_id', 'product_id');
    }
    public function seller()
    {
        return $this->belongsTo(Admin::class, "created_by", "id");
    }
    public function sellerProducts()
    {
        $vendorId = Auth::guard('admin')->user()->id;
        $vendorProducts = Product::where('vendor_id', $vendorId)->get();
    }
    public function shippingMethods()
    {
        return $this->hasMany(ProductShipping::class, 'product_id', 'id');
    }
    public function scopeBarcodeList($query)
    {
        return $array = array("C39", "C39+", "C39E", "C39E+", "C93", "I25", "POSTNET", "EAN2", "EAN5", "PHARMA2T");
    }
    public function gsttax()
    {
        return $this->belongsTo(GstTax::class, 'tax_id', 'id');
    }

}
