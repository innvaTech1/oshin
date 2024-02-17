<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesalePrice extends Model
{
    use HasFactory;

    protected $fillable = ['sku_id', 'min_qty', 'max_qty', 'price', 'status', 'created_by', 'updated_by'];
}
