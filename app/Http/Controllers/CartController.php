<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService): View
    {
        $cart = $cartService->getCartDetails();
        
        return view("doko.cart", ["cart"=>$cart]);
    }
    public function addToCart(CartService $cartService, $productId): View
    {
        $cartService->addToCart($productId, 1);
        $cart = $cartService->getCartDetails();
        
        return view("doko.cart", ["cart"=>$cart]);
    }
}

