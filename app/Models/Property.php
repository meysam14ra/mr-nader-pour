<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }
    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id');
    // }
    
    public function scopeFilter($query)
    {
        if (request()->has('bedrooms')) {
            $bedrooms = explode(',',request()->bedrooms,);
            // dd($bedrooms);
            $query->whereIn('bedrooms', $bedrooms);
        }
        
        if (request()->has('plusbedrooms')) {
            $plusbedrooms = request()->plusbedrooms;
            $query->where('bedrooms', '>', $plusbedrooms);
        }
        if (request()->has('category_id')) {
            $category_id = request()->category_id;
            $query->where('category_id', $category_id);
        }
        if (request()->has('type')) {
            $type = request()->type;
            $query->where('type', $type);
        }
        if (request()->has('max_price')) {
            $max_price = request()->max_price;
            $query->where('price', '<', $max_price);
        }
        if (request()->has('min_price')) {
            $min_price = request()->min_price;
            $query->where('price', '>', $min_price);
        }
        if (request()->has('min_size')) {
            $min_size = request()->min_size;
            $query->where('size', '>', $min_size);
        }
        if (request()->has('max_size')) {
            $max_size = request()->max_size;
            $query->where('size', '<', $max_size);
        }
        if (request()->has('provider')) {
            $provider = request()->provider;
            $query->where('inserter_role', $provider);
        }
    }
}
