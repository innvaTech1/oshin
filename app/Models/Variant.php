<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'price', 'compare_at_price', 'cost_per_item', 'taxable', 'track_inventory', 'out_of_stock_track_inventory', 'sku', 'weight', 'weight_unit', 'origin', 'barcode', 'is_default', 'media_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->hasMany(VariantOption::class);
    }

    public function optionValues()
    {
        return $this->hasManyThrough(AttributeValue::class, VariantOption::class, 'variant_id', 'id', 'id', 'attribute_value_id');
    }

    public function getAttributeIdsAttribute()
    {
        return $this->options->pluck('attributeValue.attribute_id')->toArray();
    }

    public function attribues()
    {
        // get attributes and values of this variant
        return $this->options->map(function ($option) {
            return $option->attributeValue->attribute->name . ': ' . $option->attributeValue->value;
        })->implode(', ');
    }
}
