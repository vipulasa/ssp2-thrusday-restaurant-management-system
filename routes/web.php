<?php

use Illuminate\Support\Facades\Route;

// Type of routes based on the REST convention
// CREATE   - C - POST
// READ     - R - GET
// UPDATE   - U - PUT
// DELETE   - D - DELETE

// DON'T DO THIS, UNLESS YOU HAVE A GOOD REASON
Route::get('sample', function () {
    return 'THIS IS USING A CLOSURE';
});

// DO THIS FOR ANY CUSTOM LOGIC OR FUNCTIONALITY
Route::get('sample/say-hello', [
    \App\Http\Controllers\SampleController::class,
    'sayHello'
]);

// INVOKABLE CONTROLLER ROUTE, USE THIS FOR SIMPLE ROUTES
// THAT WILL HAVE ONLY ONE PURPOSE
Route::get(
    uri:'sample/dashboard',
    action:\App\Http\Controllers\DashboardController::class
);

// RESOURCE CONTROLLER ROUTES CAN BE FOUND EVERYWHERE :P

// Administration routes
require __DIR__ . '/modules/administration.php';

// Customer routes
require __DIR__ . '/modules/customer.php';

// Menu Routes
require __DIR__ . '/modules/menu.php';

// Payment Routes
require __DIR__ . '/modules/payment.php';

// Report Routes
require __DIR__ . '/modules/reports.php';

// Reservation Routes
require __DIR__ . '/modules/reservations.php';

// Restaurant Routes
require __DIR__ . '/modules/restaurant.php';

// Rewards Routes
require __DIR__ . '/modules/rewards.php';





Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');




});

Route::middleware([
    'role:Administrator',
])->get('/admin', function(){

    dd(\Illuminate\Support\Facades\Gate::allows('admin'));


    return 'Adoo Admin !!!';
});

Route::middleware([])->get('/test', function(){

    if(!\Illuminate\Support\Facades\Gate::allows(
        'role',
        \App\Enums\UserRole::Administrator
    )){
        abort(403);
    }

    return 'Adoo Admin !!!';
});
