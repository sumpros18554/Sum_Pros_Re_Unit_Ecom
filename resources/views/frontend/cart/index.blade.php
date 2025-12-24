@extends('frontend.layout.master')

@section('title', 'Shopping Cart')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">

        @if(empty($cart))
            <div class="text-center py-5">
                <h4>Your cart is empty</h4>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        @else

        <form action="{{ route('cart.updateAll') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th width="150">Quantity</th>
                            <th>Total</th>
                            <th>Handle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $subtotal = 0; @endphp

                        @foreach($cart as $id => $item)
                            @php
                                $total = $item['price'] * $item['quantity'];
                                $subtotal += $total;
                            @endphp
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image'] ?? 'frontend/assets/images/no-image.png') }}"
                                             class="img-fluid me-5 rounded-circle"
                                             style="width: 80px; height: 80px;">
                                    </div>
                                </th>

                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>

                                <td>
                                    <p class="mb-0 mt-4">${{ number_format($item['price'], 2) }}</p>
                                </td>

                                <td>
                                    <input type="number"
                                           name="quantities[{{ $id }}]"
                                           value="{{ $item['quantity'] }}"
                                           min="1"
                                           class="form-control text-center mt-3">
                                </td>

                                <td>
                                    <p class="mb-0 mt-4">${{ number_format($total, 2) }}</p>
                                </td>

                                <td>
                                    <a href="{{ route('cart.remove', $id) }}"
                                       onclick="return confirm('Remove this item?')"
                                       class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">
                    Update Cart
                </button>
            </div>
        </form>

        @php
            $shipping = 3;
            $grandTotal = $subtotal + $shipping;
        @endphp

        <div class="row g-4 justify-content-end mt-5">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">
                            Cart <span class="fw-normal">Total</span>
                        </h1>

                        <div class="d-flex justify-content-between mb-4">
                            <h5>Subtotal:</h5>
                            <p>${{ number_format($subtotal, 2) }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h5>Shipping</h5>
                            <p>Flat rate: ${{ number_format($shipping, 2) }}</p>
                        </div>
                    </div>

                    <div class="py-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="ps-4">Total</h5>
                        <p class="pe-4">${{ number_format($grandTotal, 2) }}</p>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                        Proceed Checkout
                    </a>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>



@endsection
