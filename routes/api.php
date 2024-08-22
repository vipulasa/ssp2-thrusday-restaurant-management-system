<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')
    ->get('/user', [UserController::class, 'show']);

Route::post('/user/auth', [UserController::class, 'authenticate']);


Route::get('/restaurants', function(){

    $restaurant = \App\Models\Restaurant::first();

    return response()->json([
        'name' => 'Restaurants',
        'description' => 'List of all restaurants',
//        'restaurant' => \App\Http\Resources\Restaurant::make($restaurant),
        'restaurants' => \App\Http\Resources\RestaurantCollection::make(\App\Models\Restaurant::all()),
    ]);
});

