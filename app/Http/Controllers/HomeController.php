<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Collection;


class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::all();
        $Collections = Collection::all();

        $newArrivals = Product::where("isNewArrival", "1")->orderBy("id", "desc")->get();
        $bestSellers = Product::where("isBestSeller", "1")->orderBy("id", "desc")->get();
        $featured = Product::where("isFeatured", "1")->orderBy("id", "desc")->get();
        $specialOffers = Product::where("isSpecialOffer", "1")->orderBy("id", "desc")->get();
        // dd($newArrivals);

        return view(
            'home',
            [
                'banners' => $banners,
                'collections' => $Collections,
                'featured'=> $featured,
                'specialOffer'=> $specialOffers,
                'bestSellers'=> $bestSellers,
                'newArrival'=> $newArrivals
            ]
        );
    }
}
