<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();

        // Loop through each product to calculate discount percentage
        foreach ($products as $product) {
            if ($product->price > 0) {
                $product->discount_percentage = round(($product->discount / $product->price) * 100);
            } else {
                $product->discount_percentage = 0; 
            }
        }

        // Filter products that have a discount
        $discountedProducts = $products->filter(function ($product) {
            return $product->discount > 0;
        });

          // Filter produk tanpa diskon
         $nonDiscountedProducts = $products->filter(function ($product) {
        return $product->discount <= 0;
        });

        // Cek apakah user ingin melihat halaman diskon
        if ($request->is('discount')) {
            return view('discount', compact('discountedProducts'));
        }

         return view('front.index', compact('categories', 'products', 'discountedProducts', 'nonDiscountedProducts'))->with('success', 'Payment Successful');
    }

    public function detailProduct(Product $product)
    {
        // Return view with product data
        return view('front.detail', compact('product'));
    }
    
    public function showCategory($slug)
    {
    // Cari kategori berdasarkan slug
    $category = Category::where('slug', $slug)->firstOrFail();

    // Ambil produk yang berhubungan dengan kategori tersebut
    $products = $category->products;

    // Return view dengan kategori dan produk terkait
    return view('front.category', compact('category', 'products'));
    }


}