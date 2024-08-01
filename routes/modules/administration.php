<?php

use Illuminate\Support\Facades\Route;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Administrator',
])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource(
            name: 'users',
            controller: \App\Http\Controllers\UserController::class
        );
    });





