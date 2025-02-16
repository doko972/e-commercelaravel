<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Page;
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
            'headPages' => Page::where("isHead", 1)->get()->toArray(), // ✅ Convertir directement la collection en tableau
            'footPages' => Page::where("isFoot", 1)->get()->toArray(),
        ];
    
        Session::put('pages', $pages);
    
        // dd(Session::get('pages')); // DEBUG : Vérifier que la session contient bien les pages
        return $next($request);
    }
}
