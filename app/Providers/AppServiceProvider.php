<?php

namespace App\Providers;

use App\Models\CategoryFood;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        Blade::component('Customer.components.product-card', 'product-card');
        Blade::component('Customer.components.product-card-2', 'product-card-2');

        View::composer('Customer.layouts.navbar', function ($view) {
            $view->with('categories', CategoryFood::all());
        });
    }
}
