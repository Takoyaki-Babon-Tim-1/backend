<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cartItems = AddToCart::where('user_id', $user->id)->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->total * $item->quantity;
        }
        $cartItems = AddToCart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cart = AddToCart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->input('quantity', 1);
            $cart->save();
        } else {
            AddToCart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('front.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $cartId)
    {
        $cart = AddToCart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        if ($request->quantity > 0) {
            $cart->update(['quantity' => $request->quantity]);
        } else {
            return $this->destroy($cartId);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($cartId)
    {
        $cart = AddToCart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

   
}
