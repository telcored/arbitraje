<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        // Force HTTPS for all URLs
        URL::forceScheme('https');

        Paginator::useBootstrapFive();

        Blade::if('permission', function ($permissions) {
            $user = auth()->user();
            if (! $user) {
                return false;
            }

            return $user->hasPermission($permissions);
        });
    }
}
