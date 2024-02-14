<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "attribute_value_id",
    ];
    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
