<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
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
    uri: 'sample/dashboard',
    action: \App\Http\Controllers\DashboardController::class
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

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/test-event', function () {
    event(new \App\Events\TestEvent());
});

//Route::get('user/{id}', function ($id) {
//
//    $user = User::where('role', UserRole::Customer)
//        ->where('id', $id)
//        ->firstOrFail();
//    dd($user);
//});

Route::get('user/{customer}', function (User $user) {
    return response()->json([
        'status' => true,
        'data' => \App\Http\Resources\UserResource::make($user)
    ]);
});

Route::get('validator', function (Request $request) {

    try {
        $validator = $request->validate([
            'name' => 'required|max:2',
        ]);


        dd($validator);
    } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->validator);
    }


});


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
])->get('/admin', function () {

    dd(\Illuminate\Support\Facades\Gate::allows('admin'));
    return 'Adoo Admin !!!';
});

Route::middleware([])->get('/test', function () {

    if (!\Illuminate\Support\Facades\Gate::allows(
        'role',
        \App\Enums\UserRole::Administrator
    )) {
        abort(403);
    }

    return 'Adoo Admin !!!';
});


Route::get('/cache', function () {

    // helper method
    // cache();

    // facade
    // \Illuminate\Support\Facades\Cache::get();

    if($home_page = cache()->get('home_page')) {
        $user = (new User())->get();

        $restaurant = (new \App\Models\Restaurant())->get();

        $cuisine = (new \App\Models\Cuisine())->get();

        $home_page = [
            'user' => $user,
            'restaurant' => $restaurant,
            'cuisine' => $cuisine,
        ];

        cache()->put('home_page', $home_page, 60);
    }

    return view('cache', compact('home_page'));
});

Route::get('/session', function (Request $request) {

    // helper method
    // session();

    // facade
    // \Illuminate\Support\Facades\Session::get();

    $user = (new User())->first();

//    session()->put('user', [
//        'id' => $user->id,
//        'name' => $user->name,
//        'email' => $user->email,
//    ]);

//    session()->forget('name');

//    session()->flash('message', 'This is a flash message');

    $request->session()->put('something', [
        'name' => 'John Doe'
    ]);

    return view('session');
});

Route::get('/notification', function (Request $request) {

    $user = (new User())->first();

    $user->notify(new \App\Notifications\DatabaseSampleNotification());

//
//    $user->notify(new \App\Notifications\SampleNotification());

    return view('notification', [
        'user' => $user
    ]);
});
