<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'slug', 'thumb_image', 'user_id', 'brand_id', 'unit_id', 'qty', 'short_description', 'long_description', 'additional_information', 'video_link', 'sku', 'batch', 'meta_title', 'meta_description', 'price', 'discount', 'discount_type', 'offer_start_date', 'offer_end_date', 'is_cod', 'is_verified', 'is_wholesale', 'is_pre_order', 'release_date', 'max_product', 'is_partial', 'partial_amount', 'delivery_location', 'badge', 'tags', 'is_return', 'return_policy_id', 'is_warranty', 'warranty_duration', 'show_homepage', 'is_undefine', 'is_featured', 'is_new', 'is_top', 'is_bestseller', 'is_flash_deal', 'buyone_getone', 'status', 'viewed', 'created_by', 'updated_by', 'deleted_by'];

    // public static function boot()
    // {
    //     parent::boot();
    //     static::saving(function ($model) {
    //         if ($model->created_by == null) {
    //             $model->created_by = Auth::guard('admin')->user()->id ?? null;
    //         }
    //     });
    //     static::updating(function ($model) {
    //         $model->updated_by = Auth::guard('admin')->user()->id ?? null;
    //     });
    //     self::creating(function ($model) {
    //         $model->slug = $model->createSlug($model->product_name);
    //     });
    //     self::created(function ($model) {
    //         Cache::forget('MegaMenu');
    //         Cache::forget('HeaderSection');
    //     });
    //     self::updating(function ($model) {
    //         $model->slug = $model->createSlug($model->product_name, $model->id);
    //     });
    //     self::updated(function ($model) {
    //         Cache::forget('MegaMenu');
    //         Cache::forget('HeaderSection');
    //     });
    //     self::deleted(function ($model) {
    //         Cache::forget('MegaMenu');
    //         Cache::forget('HeaderSection');
    //     });
    // }
    public function unit_type()
    {
        return $this->belongsTo(UnitType::class)->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
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

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function getWishlistsAttribute()
    {
        if (auth()->check() && $this->relationLoaded('wishlists')) {
            return $this->getRelation('wishlists')->where('user_id', auth()->id());
        }
        return [];
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
    public function getCartAttribute()
    {
        if (auth()->check() && $this->relationLoaded('cart')) {
            return $this->getRelation('cart')->where('user_id', auth()->id());
        }
        return [];
    }
    public function orders()
    {
        return $this->hasMany(OrderDetails::class, 'product_id', 'id');
    }
}
