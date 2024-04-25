<?php

namespace Modules\Media\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'path', 'alt_text', 'description', 'height', 'width', 'mime_type', 'size'];


    public function getPathAttribute(){

        $path = $this->attributes['path'];
        $public_path = str_contains(request()->getHttpHost(), '127.0.0.1') ? '' : 'public/';

        return $public_path . $path;
    }
}
