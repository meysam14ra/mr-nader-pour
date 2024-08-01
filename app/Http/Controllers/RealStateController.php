<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\City;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\getPropertiesResources;
use App\Http\Resources\property\RentalResource;
use App\Http\Resources\property\singleProperty;
use App\Models\Property;

class RealStateController extends ApiController
{
    public function properties(Request $request)
    {


        $properties = Property::filter()->where('publish', 1)->where('accept', '1')->paginate(12);

        $images = Image::all();



        try {
            return $this->successResponse([
                'properties' => getPropertiesResources::collection($properties),
                'links' => getPropertiesResources::collection($properties)->response()->getData()->links,
                'meta' => getPropertiesResources::collection($properties)->response()->getData()->meta,


            ], 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }

    public function singleProperty($slug)
    {

        $property = Property::where('slug', $slug)->first();
        $images = Image::all();



        return $this->successResponse(new RentalResource($property), 200);
    }











    public function allrealState(Request $request)
    {
        $city = $request->city;
        $properties = Property::filter()->where('publish', 1)->where('accept', '1')->get();
        $images = Image::all();



        try {
            return $this->successResponse(getPropertiesResources::collection($properties), 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }
    public function allrental(Request $request)
    {
        $city = $request->city;
        $properties = Property::filter()->whereIn('category_id', [3, 4, 5])->where('publish', 1)->where('accept', '1')->get();
        $images = Image::all();



        try {
            return $this->successResponse(getPropertiesResources::collection($properties), 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }
    public function allsell(Request $request)
    {
        $city = $request->city;
        $properties = Property::filter()->whereIn('category_id', [6, 7, 8])->where('publish', 1)->where('accept', '1')->paginate(6);
        // dd($properties);
        $images = Image::all();



        try {
            return $this->successResponse([
                'properties' => getPropertiesResources::collection($properties),
                'links' => getPropertiesResources::collection($properties)->response()->getData()->links,
                'meta' => getPropertiesResources::collection($properties)->response()->getData()->meta,


            ], 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }
}
