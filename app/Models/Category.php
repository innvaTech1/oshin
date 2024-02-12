<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

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
    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function brands(){
        // return $this->belongsToMany(Brand::class);
    }
    public function products(){
        // return $this->belongsToMany(Product::class)->withPivot('category_id', 'product_id');
    }
}
