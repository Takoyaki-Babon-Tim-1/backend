<?php
namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = AddToCart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
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

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($cartId)
    {
        $cart = AddToCart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}

