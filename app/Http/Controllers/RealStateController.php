<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\City;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Resources\getPropertiesResources;
use App\Http\Resources\property\RentalResource;


class RealStateController extends ApiController
{
public function residential( Request $request){
    $city=City::findOrFail($request->city);
    $residentails = $city->properties()->get();
     $images = Image::all();
    
    
    try {
    return $this->successResponse(  getPropertiesResources::collection($residentails) , 201);
} catch (Throwable $error) {
    
    return $this->errorResponse($error, 500);
};
}}
