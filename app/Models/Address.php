<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'email',
        'is_default',
        'type',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'state', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'city', 'id');
    }
}
