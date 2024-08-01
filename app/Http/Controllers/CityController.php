<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;

class CityController extends ApiController
{
    public function get_cities()
    {
        $cities = City::all();
        // return $this->successResponse($cities, 200);
        return $this->successResponse( CityResource::collection($cities));

    }
}
