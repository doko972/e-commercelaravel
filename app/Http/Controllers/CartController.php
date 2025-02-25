<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // Ajoutez cette ligne
use App\Services\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService): View
    {
        $cart = $cartService->getCartDetails();
       
        return view("doko.cart", ["cart"=>$cart]);
    }

    public function addToCart(CartService $cartService, $productId): RedirectResponse // Modifiez ici
    {
        $cartService->addToCart($productId, 1);
        $cart = $cartService->getCartDetails();
       
        return redirect()->route('cart', ['cart'=>$cart]);
    }

    public function removeFromCart(CartService $cartService, $productId, $quantity): RedirectResponse // Modifiez ici
    {
        $cartService->removeFromCart($productId, $quantity);
        $cart = $cartService->getCartDetails();
        return redirect()->route('cart', ['cart'=>$cart]);
    }
}