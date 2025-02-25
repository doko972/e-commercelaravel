<?php

namespace App\Services;

use App\Models\Product; // Assurez-vous d'importer le modèle Product ici
use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart($productId, $quantity)
    {
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put('cart', $cart);
    }
    
    public function removeFromCart($productId, $quantity)
    {
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            if ($cart[$productId] <= $quantity) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] -= $quantity;
            }

            Session::put('cart', $cart);
        }
    }

    public function clearCart()
    {
        Session::forget('cart');
    }

    public function getCartDetails()
    {
        $cart = Session::get('cart', []);
        $result = [
            'items' => [],
            'sub_total' => 0,
            'cart_count' => 0,
        ];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subTotal = $product->soldePrice * $quantity;
                $result['items'][] = [
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'soldePrice' => $product->soldePrice,
                        'regularPrice' => $product->regularPrice,
                        'imageUrls' => $product->imageUrls(),
                        // Ajoutez d'autres attributs du produit ici
                    ],
                    'quantity' => $quantity,
                    'sub_total' => $subTotal,
                ];
                $result['sub_total'] += $subTotal;
                $result['cart_count'] += $quantity;
            }
        }

        return $result;
    }

}