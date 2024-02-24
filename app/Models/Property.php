<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }
}
