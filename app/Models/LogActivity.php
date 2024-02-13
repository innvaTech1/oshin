<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'type', 'url', 'method', 'ip', 'login', 'login_time', 'logout_time', 'agent', 'user_id', 'user_type',
    ];
    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
