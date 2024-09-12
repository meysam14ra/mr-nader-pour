<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\ads\PropertyController;
use App\Http\Controllers\user\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->middleware('auth:api')->group(function () {

    Route::prefix('/property')->group(function () {
        Route::controller(PropertyController::class)->group(function () {
            Route::post('/create_rental', 'create_rental');
            Route::get('/get_city', 'get_cities');
            Route::get('/get_rental/{id}', 'get_rental');
            Route::post('/create_amenities/{id}', 'create_amenities');
            Route::post('/create_media/{id}', 'create_media');
            Route::post('/contact_details/{id}', 'contact_details');
            Route::post('/edit_rental_datails/{id}', 'edit_rental_datails');
            Route::post('/delete_media/{id}', 'delete_media');
        });
    });
    Route::prefix('/dashboard')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
           
            Route::get('/activeAds', 'activeAds');
           
        });
    });
});
