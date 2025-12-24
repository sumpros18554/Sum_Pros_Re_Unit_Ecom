<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display cart items
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')
                ->with('cart_empty', '🛒 Your cart is currently empty.');
        }

        return view('frontend.cart.index', compact('cart'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check if product is in stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', '❌ This product is out of stock.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Check if adding one more exceeds stock
            if ($cart[$id]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', '⚠️ Not enough stock for this product.');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'        => $product->name,
                'price'       => $product->price,
                'description' => $product->description,
                'quantity'    => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '✅ Product added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $product = Product::findOrFail($request->id);
            $cart[$request->id] = [
                'name'        => $product->name,
                'price'       => $product->price,
                'description' => $product->description,
                'quantity'    => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '✅ Cart item updated!');
    }

    /**
     * Update all cart items at once
     */
    public function updateAll(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!$request->has('quantities') || !is_array($request->quantities) || count($request->quantities) === 0) {
            return redirect()->back()->with('error', '⚠️ No items to update in the cart.');
        }

        foreach ($request->quantities as $id => $quantity) {
            $quantity = (int)$quantity;
            $product = Product::find($id);

            if (!$product) continue;

            if ($quantity > $product->stock) {
                return redirect()->back()->with('error', "⚠️ Requested quantity for '{$product->name}' exceeds available stock.");
            }

            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = [
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'description' => $product->description,
                    'quantity'    => $quantity,
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '✅ Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', '🗑️ Item removed from cart.');
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', '🧹 Cart has been cleared.');
    }
}
