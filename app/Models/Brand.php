<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\app\Models\Media;

class Brand extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    use HasFactory;

    protected $fillable = [
        "name", "logo", "description", "link", "status", "featured", "meta_title", "meta_description", "sort_id", 'total_sale', 'avg_rating', "slug", "created_by", "updated_by",
    ];
    // public static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($brand) {
    //         $brand->created_by = Auth::guard('admin')->user()->id ?? null;
    //     });

    //     static::updating(function ($brand) {
    //         $brand->updated_by = Auth::guard('admin')->user()->id ?? null;
    //     });
    //     self::created(function ($model) {
    //         Cache::forget('MegaMenu');
    //         Cache::forget('HeaderSection');
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

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function logo()
    {
        return $this->belongsTo(Media::class, 'logo', 'id');
    }

    public function getLogoPathAttribute()
    {
        $media = Media::where('id', $this->attributes['logo'])->first();
        return $media->path;
    }

    public function getLogoAttribute()
    {
        $media = Media::where('id', $this->attributes['logo'])->first();
        return asset($media->path);
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

    // public function categories()
    // {
    //     return $this->hasManyDeep(
    //         Category::class,
    //         [
    //             Product::class,
    //             CategoryProduct::class,
    //         ],
    //         [
    //             'brand_id', // Foreign key on the "products" table.
    //             'category_id', // Foreign key on the "category_product" table.
    //             'id', // Local key on the "brands" table.
    //         ],
    //         [
    //             'id', // Local key on the "products" table.
    //             'brand_id', // Foreign key on the "category_product" table.
    //             'category_id', // Foreign key on the "categories" table.
    //         ]
    //     );
    // }
}
