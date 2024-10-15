<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        // If product already in cart, increase quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Add product to cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "total_price" => $product->total_price,
                "thumbnail" => $product->thumbnail
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
{
    $cart = session()->get('cart');
    
    if ($request->action == 'increase') {
        $cart[$id]['quantity']++;
    } elseif ($request->action == 'decrease') {
        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }
    }

    // Update total price after quantity change
    $cart[$id]['total_price'] = $cart[$id]['price'] * $cart[$id]['quantity'];

    session()->put('cart', $cart);
    
    return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
}


    // Display cart
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Remove product from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
