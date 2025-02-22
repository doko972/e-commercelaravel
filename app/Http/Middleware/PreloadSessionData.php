<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Page;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class PreloadSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $pages = [
            'headPages' => Page::where("isHead", 1)->get(),
            'footPages' => Page::where("isFoot", 1)->get(),
        ];
        $mega_menus = [
            'categories' => Category::where("isMega", 1)->get()
        ];
        Session::put('pages', $pages);
        Session::put('mega_menus', $mega_menus);

        return $next($request);
    }
}
