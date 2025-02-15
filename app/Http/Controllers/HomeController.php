<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Banner;


class HomeController extends Controller
{
    public function index():View
    {
        $banners = Banner::all();
        return view('home', ['banners' => $banners]);
    }
}
