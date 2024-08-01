<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RealStateController;


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

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/realState', [RealStateController::class, 'properties']);
Route::get('/cities', [CityController::class, 'get_cities']);
Route::get('/allrealState', [RealStateController::class, 'allrealState']);
Route::get('/allrental', [RealStateController::class, 'allrental']);
Route::get('/allsell', [RealStateController::class, 'allsell']);
Route::get('/property/{property:slug}', [RealStateController::class, 'singleProperty']);
