<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        "value",
        "attribute_id",
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
    public function color()
    {
        return $this->hasOne(Color::class);
    }
    public function productVariation()
    {
        return $this->hasOne(ProductVariations::class, 'attribute_value_id', 'id');
    }
}
