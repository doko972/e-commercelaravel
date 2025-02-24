<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Page;
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
                'featured' => $featured,
                'specialOffer' => $specialOffers,
                'bestSellers' => $bestSellers,
                'newArrival' => $newArrivals
            ]
        );
    }

    public function showPage(string $slug): view
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('doko.page', ['page' => $page]);
    }

    public function showProduct(string $slug): view
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('doko.product', ['product' => $product]);
    }

    public function contact(): view
    {

        return view('doko.contact');
    }

    public function shop(Request $req): View
    {
        $sort = $req->input('sort');
        $showing = $req->input('showing');
        $pageLimit = 8;
        if($showing && is_numeric($showing)){
            $pageLimit = (int)$showing;
        }
        $products = Product::query();
        if ($sort) {
            $filter = $sort === 'price-desc' ? 'desc' : 'asc';
            $products = $products->orderBy('soldePrice', $filter);
        }
            // onEachSide pour la pagination 3 elements avant et 3 elements apres
            $products = $products->paginate($pageLimit)->onEachSide(1);
        
        return view('doko.shop', ['products' => $products]);
    }
}
