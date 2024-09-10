<?php

namespace App\Http\Controllers\user;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\getPropertiesResources;

class DashboardController extends ApiController
{
    public function activeAds()
    {
        $activeAds = auth()->user()->ads()->where('accept','1')->where('publish','1')->paginate(6);
        


        try {
            return $this->successResponse([
                'meta' => getPropertiesResources::collection($activeAds)->response()->getData()->meta,
                'properties' => getPropertiesResources::collection($activeAds),
                'links' => getPropertiesResources::collection($activeAds)->response()->getData()->links,


            ], 201);
        } catch (Throwable $error) {

            return $this->errorResponse($error, 500);
        };
    }
}
