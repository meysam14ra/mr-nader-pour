<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\City;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\getPropertiesResources;
use App\Http\Resources\property\RentalResource;
use App\Models\Property;

class RealStateController extends ApiController
{
    public function properties(Request $request)
    {
        $city = $request->city;
        $category = $request->category_id;
        // $residentails = $city->properties()->get();
        $properties = Property::where('city_id', $city)->where('category_id', $category)->where('publish', 1)->where('accept','1')->get();
        $images = Image::all();



        try {
            return $this->successResponse(getPropertiesResources::collection($properties), 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }
}
