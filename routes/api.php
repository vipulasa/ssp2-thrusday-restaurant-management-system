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



