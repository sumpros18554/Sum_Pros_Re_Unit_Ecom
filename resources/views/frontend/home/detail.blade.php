@extends('frontend.layout.master')

@section('title', $product->name ?? 'Product Detail')

@section('content')

<div class="shop-detail-box-main mt-5">
    <div class="container">
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->product_id }}">

            <div class="row g-4">

                <!-- Product Images -->
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carouselProduct" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset($product->image_url) }}" class="d-block w-100 rounded" alt="{{ $product->name }}">
                            </div>
                            @if(isset($product->gallery) && count($product->gallery) > 0)
                                @foreach($product->gallery as $image)
                                    <div class="carousel-item">
                                        <img src="{{ asset($image) }}" class="d-block w-100 rounded" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if(isset($product->gallery) && count($product->gallery) > 0)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                        <h5 class="fw-bold mb-3">${{ number_format($product->price, 2) }}</h5>
                        <p class="mb-3">
                            <span>{{ $product->stock }} available</span>
                        </p>

                        <!-- Ratings -->
                        <div class="d-flex mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star {{ $i <= ($product->rating ?? 0) ? '' : 'text-secondary' }}"></i>
                            @endfor
                        </div>

                        <h4>Description:</h4>
                        <p>{{ $product->description ?? 'No description available.' }}</p>

                        <!-- Quantity Selector -->
                        <div class="form-group mb-4" style="max-width:120px;">
                            <label class="control-label mb-2">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                        </div>

                        <!-- Add to Cart Button -->
                        <div class="cart-and-bay-btn mb-4">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                <i class="fa fa-shopping-bag me-2"></i> Add to Cart
                            </button>
                        </div>

                        <!-- Optional Product Details -->
                        <div class="row g-2">
                            @if($product->weight)
                                <div class="col-6">
                                    <p class="mb-1"><strong>Weight:</strong> {{ $product->weight }}</p>
                                </div>
                            @endif
                            @if($product->origin)
                                <div class="col-6">
                                    <p class="mb-1"><strong>Origin:</strong> {{ $product->origin }}</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
