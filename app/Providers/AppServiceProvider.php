<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Routing\Route;
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
        // Route::aliasMiddleware('admin', AdminMiddleware::class);
    }
}
