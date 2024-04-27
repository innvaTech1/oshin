<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $table = 'thanas';
    protected $fillable = [
        'district_id',
        'name',
        'bn_name',
        'latitude',
        'longitude',
        'website',
        'status',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
