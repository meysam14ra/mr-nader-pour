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
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeFilter($query)
    {


        if (request()->has('sortBy')) {
            $sortBy = request()->sortBy;

            switch ($sortBy) {
                case 'Most-Recent':
                    $query->whereNotNull('published_at')->orderBy('published_at', 'desc');
                    break;
                case 'Lo-Price':
                    $query->orderBy('price')->orderBy('monthly_rent');
                    break;
                case 'Hi-Price':
                    $query->orderBy('price','Desc')->orderBy('monthly_rent','Desc');

                    break;
                case 'Most-Relevant':
                    $query->where('quantity', '>', 0)->where('sale_price', '!=', 0)->where('date_on_sale_from', '<', Carbon::now())->where('date_on_sale_to', '>', Carbon::now());
                    break;
                default:
                    $query;
                    break;
            }
        }


        if (request()->has('category_id')) {
            $category_id = explode(',', request()->category_id);

            $query->whereIn('category_id', $category_id);
        }
        if (request()->has('city')) {
            $city = request()->city;
            $query->where('city_id', $city);
        }

        if (request()->has('furnish')) {
            $furnish = explode(',', request()->furnish,);
            $query->whereIn('furnish', $furnish);
        }
        if (request()->has('inserter_role')) {
            $inserter_role = explode(',', request()->inserter_role,);
            $query->whereIn('inserter_role', $inserter_role);
        }
        if (request()->has('place_type')) {
            $place_type = explode(',', request()->place_type,);
            $query->whereIn('place_type', $place_type);
        }
        if (request()->has('bedrooms')) {
            $bedrooms = explode(',', request()->bedrooms,);

            $query->whereIn('bedrooms', $bedrooms);
        }
        if (request()->has('bathrooms')) {
            $bathrooms = explode(',', request()->bathrooms,);
            $query->whereIn('bathrooms', $bathrooms);
        }


        if (request()->has('pet_friendly')) {
            $pet_friendly = request()->pet_friendly;
            $query->where('pet_friendly',  $pet_friendly);
        }

        if (request()->has('type')) {
            $type = explode(',', request()->type,);
            $query->whereIn('type', $type);
        }

        if (request()->has('max_price')) {
            $max_price = request()->max_price;
            $query->where('price', '<=', $max_price);
        }
        if (request()->has('min_price')) {
            $min_price = request()->min_price;
            $query->where('price', '>=', $min_price);
        }

        if (request()->has('max_rent')) {
            $max_rent = request()->max_rent;
            $query->where('monthly_rent', '<=', $max_rent);
        }
        if (request()->has('min_rent')) {
            $min_rent = request()->min_rent;
            $query->where('monthly_rent', '>=', $min_rent);
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
        if (request()->has('rental_period')) {
            $rental_period = request()->rental_period;
            $query->where('rental_period', $rental_period);
        }
    }
}
