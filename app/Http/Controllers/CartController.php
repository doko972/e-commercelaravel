<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view("doko.cart");
    }
    public function addToCart(Request $request, $productId): View
    {
        $cart = $request->session()->get('cart', []);
        if(isset($cart[$productId])){
            $cart[$productId]++;
        }else{
            $cart[$productId] = 1;
        }
        $request->session()->put('cart', $cart);
        
        return view("doko.cart");
    }
}

