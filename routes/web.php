<?php

use Illuminate\Support\Facades\Route;

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
