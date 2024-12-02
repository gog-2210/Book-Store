<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('*', function ($view) {
            $view->with('cart', app(CartService::class)->getCart());

            $view->with('parentCategories', app(CategoryService::class)->getByParentID(0));
            $view->with('categories', app(CategoryService::class)->getAll());
        });
    }
}
