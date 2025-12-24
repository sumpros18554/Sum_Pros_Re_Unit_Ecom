@extends('frontend.layout.master')

@section('title', 'Order Confirmation')

@section('content')
<div class="cart-box-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm border-0 p-4 text-center">
                    <div class="card-body">
                        <h2 class="card-title text-success mb-3">Thank you for your order!</h2>
                        <p class="card-text mb-4">Your order has been successfully placed. We will process it shortly.</p>

                        <div class="order-summary border-top border-bottom py-3 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="font-weight-bold">Order ID:</span>
                                <span class="text-primary font-weight-bold">{{ $order->order_id }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Total:</span>
                                <span class="text-primary font-weight-bold">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg w-100">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
