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

        return view("doko.cart", ["cart" => $cart]);
    }

    public function addToCart(CartService $cartService, $productId, Request $request): RedirectResponse
    {
        $cartService->addToCart($productId, 1);

        // Ajouter un flash message pour l'utilisateur
        session()->flash('success', 'Produit ajouté au panier');

        // Rediriger vers la page précédente si disponible, sinon vers le panier
        return redirect()->back()->withInput();
    }

    public function getCartCount(CartService $cartService)
    {
        $cartDetails = $cartService->getCartDetails();
        return response()->json([
            'count' => $cartDetails['cart_count'],
            'subtotal' => $cartDetails['sub_total']
        ]);
    }

    public function removeFromCart(CartService $cartService, $productId, $quantity): RedirectResponse
    {
        $cartService->removeFromCart($productId, $quantity);
        return redirect()->route('cart');
    }
}