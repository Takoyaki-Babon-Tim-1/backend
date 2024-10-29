<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
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

        return view('front.index', compact('categories', 'products', 'discountedProducts'))->with('success', 'Payment Successful');
    }

    public function detailProduct(Product $product)
    {
        // Return view with product data
        return view('front.detail', compact('product'));
    }


    
}
