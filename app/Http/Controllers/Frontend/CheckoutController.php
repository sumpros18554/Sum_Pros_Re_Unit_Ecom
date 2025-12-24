<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')
                ->with('cart_empty', '🛒 Your cart is empty. Add some products before checkout!');
        }

        return view('frontend.checkout.index', compact('cart'));
    }

    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        // Validate billing details
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
        ]);

        // Get cart from session
        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->back()->with('error', '⚠️ Your cart is empty. Please add items before checking out.');
        }

        // Calculate subtotal, VAT, and total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $vat = $subtotal * 0.1; // 10% VAT
        $total = $subtotal + $vat;

        // Create order
        $order = Order::create([
            'customer_name'    => $request->customer_name,
            'customer_email'   => $request->customer_email,
            'customer_phone'   => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'total_amount'     => $total,
        ]);

        // Create order items and decrease stock
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->order_id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal'   => $item['price'] * $item['quantity'],
            ]);

            // Decrease stock
            $product = Product::find($productId);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Clear cart
        session()->forget('cart');

        // Redirect with friendly message
        return redirect('/checkout/confirm/' . $order->order_id)
            ->with('success', '✅ Your order has been placed successfully!');
    }

    /**
     * Show order confirmation page
     */
    public function confirm($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        return view('frontend.checkout.order-confirm', compact('order'))
            ->with('success', '🎉 Thank you for your purchase! Here is your order summary.');
    }
}
