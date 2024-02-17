<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SellerProduct extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'tax', 'tax_type', 'discount', 'discount_type', 'discount_start_date', 'discount_end_date', 'product_name', "slug", 'thum_img', 'status', 'stock_manage', 'is_approved', 'min_sell_price', 'max_sell_price', 'total_sale', 'avg_rating', 'recent_view',
    ];

    public static function boot()
    {
        parent::boot();
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
    protected $with = ['flashDeal'];
    protected $appends = ['variantDetails', 'MaxSellingPrice', 'hasDeal', 'rating', 'hasDiscount', 'ProductType'];

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
    public function productSKU()
    {
        return $this->belongsTo(ProductSku::class, "product_sku", "id");
    }
    public function skus()
    {
        return $this->hasMany(SellerProductSKU::class, 'product_id', 'id');
    }
    public function related_sales()
    {
        return $this->hasMany(ProductRelatedSale::class, 'product_id', 'product_id')->with('product.gstGroup');
    }
    public function getMaxSellingPriceAttribute()
    {
        return $this->attributes['max_sell_price'];
    }
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
    public function seller()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
    public function getVariantDetailsAttribute()
    {
        $product = $this->load('skus', 'skus.product_variations');
        $attr_value = array();
        foreach ($product->skus->where('status', 1) as $key => $sku) {
            foreach ($sku->product_variations as $k => $variation) {
                $blank = new \stdClass();
                $blank->value = [];
                $blank->code = [];
                $blank->attr_val_id = [];
                if (sizeof(array_filter($attr_value, function ($object) use ($variation) {
                    return $object->name == $variation->attribute->name;
                }))) {
                    foreach ($attr_value as $key => $object) {
                        $val_name = @$variation->attribute_value->color ? @$variation->attribute_value->color->name : @$variation->attribute_value->value;
                        $code = $variation->attribute_value->value;
                        $val_id = @$variation->attribute_value->color ? @$variation->attribute_value->color->attribute_value_id : @$variation->attribute_value->id;
                        if ($variation->attribute->name == $object->name) {
                            if (!in_array($val_name, $object->value, true)) {
                                array_push($object->value, $val_name);
                                array_push($object->code, $code);
                                array_push($object->attr_val_id, $val_id);
                            }
                        }
                    }
                } else {
                    $val_name = @$variation->attribute_value->color ? @$variation->attribute_value->color->name : @$variation->attribute_value->value;
                    $val_id = @$variation->attribute_value->color ? @$variation->attribute_value->color->attribute_value_id : @$variation->attribute_value->id;
                    $code = $variation->attribute_value->value;
                    $blank->name = $variation->attribute->name;
                    $blank->attr_id = $variation->attribute->id;
                    array_push($attr_value, $blank);
                    array_push($blank->value, $val_name);
                    array_push($blank->code, $code);
                    array_push($blank->attr_val_id, $val_id);
                }
            }
        }
        return $attr_value;
    }
    public function gethasDiscountAttribute()
    {
        if ($this->discount_start_date != null && $this->discount_end_date != null) {
            $start_date = date('m/d/Y', strtotime($this->discount_start_date));
            $end_date = date('m/d/Y', strtotime($this->discount_end_date));
            if ($this->discount > 0) {
                if ($start_date < date('m/d/Y') && $end_date > date('m/d/Y')) {
                    return 'yes';
                } else {
                    return 'no';
                }
            } else {
                return 'no';
            }
        } else {
            if ($this->discount > 0) {
                return 'yes';
            } else {
                return 'no';
            }
        }
    }
    public function is_wishlist()
    {
        if ($this->wishList) {
            return 1;
        } else {
            return 0;
        }
    }
    public function wishList()
    {
        $wishlist = $this->hasOne(Wishlist::class, 'seller_product_id', 'id')->where('type', 'product');
        $user_id = 0;
        if (auth()->check()) {
            $user_id = auth()->id();
        }
        $wishlist = $wishlist->where('user_id', $user_id);
        return $wishlist;
    }
}
