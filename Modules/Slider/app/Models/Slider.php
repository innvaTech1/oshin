<?php

namespace Modules\Slider\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Media\app\Models\Media;
use Modules\Slider\Database\factories\SliderFactory;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'button_text',
        'button_link',
        'status',
        'order',
    ];


    public function image_path()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path->path;
    }
}
