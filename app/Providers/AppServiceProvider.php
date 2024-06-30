<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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

        Paginator::useBootstrap();

        $websiteSetting = Setting::first();
        $categories = Category::all();
        $subcategories = Subcategory::all();

        View::share('appSetting', $websiteSetting);
        View::share('categories', $categories);
        View::share('subcategories', $subcategories);
    }
}
