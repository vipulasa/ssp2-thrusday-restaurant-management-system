<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('customer', function (string $value) {
            return User::where('role', UserRole::Customer)
                ->where('id', $value)
                ->firstOrFail();
        });

        Route::bind('admin', function (string $value) {
            return User::where('role', UserRole::Administrator)
                ->where('id', $value)
                ->firstOrFail();
        });
    }
}
