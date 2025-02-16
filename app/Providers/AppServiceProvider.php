<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Charger les pages pour toutes les vues
        $pages = [
            'headPages' => Page::where("isHead", 1)->get()->toArray(),
            'footPages' => Page::where("isFoot", 1)->get()->toArray(),
        ];

        View::share('pages', $pages);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
