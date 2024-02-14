<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attribute extends Model
{
    protected $table = "attributes";
    use HasFactory;
    protected $fillable = [
        "name",
        "display_type",
        "description",
        "status",
        "created_by",
        "updated_by",
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function colors()
    {
        return $this->hasManyThrough(Color::class, AttributeValue::class, 'attribute_id', 'attribute_value_id', 'id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($attribute) {
            $attribute->created_by = Auth::guard('admin')->user()->id ?? null;
        });

        static::updating(function ($attribute) {
            $attribute->updated_by = Auth::guard('admin')->user()->id ?? null;
        });
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
