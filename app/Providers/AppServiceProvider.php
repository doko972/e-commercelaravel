<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Product;use Illuminate\Support\Facades\Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer("*", function ($view) {
            $view->with("calculateReduction", function (Product $product) {
                return number_format((($product->regularPrice - $product->soldePrice) / $product->regularPrice) * 100,0);

            });
            $view->with("format_price", function ($soldePrice) {
                return number_format($soldePrice, 2, ',', ' ') . '€' ;

            });
            $view->with("site_title", function () {
                return "| " . Session::get('setting')?->name;

            });
        });
        View::composer('*', function ($view) {
            $view->with('mega_menus', session()->get('mega_menus'));
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
