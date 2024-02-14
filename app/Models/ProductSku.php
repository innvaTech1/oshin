<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;

    protected $fillable = ["product_id", "sku", "purchase_price", "selling_price", 'additional_shipping', 'variant_image', "status", 'product_stock', 'track_sku',
    ];
}
