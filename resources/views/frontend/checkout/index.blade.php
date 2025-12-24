@extends('frontend.layout.master')

@section('title', 'Checkout')

@section('content')
<div class="cart-box-main">
    <div class="container">

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row mt-5">
                <!-- Billing Form -->
                <div class="col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing Details</h3>
                        </div>

                        <div class="form-group mb-3">
                            <label for="customer_name" class="mb-0">Name *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Your Name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="customer_email" class="mb-0">Email *</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email Address" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="customer_phone" class="mb-0">Phone *</label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Phone Number" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="shipping_address" class="mb-0">Address *</label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Street Address" required>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-6 mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach ($cart as $id => $item)
                                    @php
                                        $rowTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $rowTotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ $item['image'] ?? 'img/default.png' }}" class="img-fluid rounded-circle" style="width: 70px; height: 70px;" alt="{{ $item['name'] }}">
                                        </td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>${{ number_format($item['price'], 2) }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>${{ number_format($rowTotal, 2) }}</td>
                                    </tr>
                                    <input type="hidden" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                @endforeach
                                @php
                                    $shipping_cost = 3;
                                    $total = $subtotal + $shipping_cost;
                                @endphp
                                <tr>
                                    <td colspan="4" class="text-end font-weight-bold">Subtotal</td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end font-weight-bold">shipping_cost</td>
                                    <td>${{ number_format($shipping_cost, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end font-weight-bold">Total</td>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="row pt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
