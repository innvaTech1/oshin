<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'name',
        'bn_name',
        'latitude',
        'longitude',
        'website',
        'status',
    ];

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
}
