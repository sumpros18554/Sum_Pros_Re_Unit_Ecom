<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display homepage with all products
     */
    public function index()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return view('frontend.home.index')
                ->with('info', 'No products are available right now. Please check back later!');
        }

        return view('frontend.home.index', compact('products'))
            ->with('success', 'Welcome! Browse our latest products below.');
    }

    /**
     * Show product detail page
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('frontend.home.detail', compact('product'))
            ->with('success', "You're viewing details for '{$product->name}'.");
    }
}
