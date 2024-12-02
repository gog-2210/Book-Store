<?php

namespace App\Providers;

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
        // Truyền dữ liệu categories vào tất cả các view
        View::composer('*', function ($view) {
            $view->with('parentCategories', app(CategoryService::class)->getByParentID(0));
            $view->with('categories', app(CategoryService::class)->getAll());
        });
    }
}
