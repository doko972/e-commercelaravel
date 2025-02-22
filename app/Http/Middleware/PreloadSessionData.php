<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\Page;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class PreloadSessionData
{
    public function handle(Request $request, Closure $next): Response
    {
        $pages = cache()->remember('pages', now()->addMinutes(30), function () {
            return [
                'headPages' => Page::where("isHead", 1)->get(),
                'footPages' => Page::where("isFoot", 1)->get(),
            ];
        });

        $mega_menus = cache()->remember('mega_menus', now()->addMinutes(30), function () {
            return [
                'categories' => Category::where("isMega", 1)
                    ->take(4)
                    ->with('products')
                    ->get(),
            ];
        });

        Session::put('pages', $pages);
        Session::put('mega_menus', $mega_menus);
        Session::save();

        return $next($request);
    }
}
