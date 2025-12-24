@extends('backend.layout.master')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow my-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h4>

                        <form
                            action="{{ isset($product) ? route('backend.products.update', $product->product_id) : route('backend.products.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label><i class="fe fe-tag"></i> Name *</label>
                                <input type="text" name="name" class="form-control form-control-lg"
                                    value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name" required>
                            </div>

                            <div class="form-group">
                                <label><i class="fe fe-align-left"></i> Description</label>
                                <textarea name="description" class="form-control form-control-lg"
                                    placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label><i class="fe fe-dollar-sign"></i> Price *</label>
                                    <input type="number" step="0.01" name="price" class="form-control form-control-lg"
                                        value="{{ old('price', $product->price ?? '') }}" placeholder="Enter price" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><i class="fe fe-box"></i> Stock *</label>
                                    <input type="number" name="stock" class="form-control form-control-lg"
                                        value="{{ old('stock', $product->stock ?? '') }}" placeholder="Enter stock" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><i class="fe fe-image"></i> Image</label>
                                @if (isset($product) && $product->image_url)
                                    <div class="mb-3">
                                        <img src="{{ asset($product->image_url) }}" alt="Product Image" class="img-thumbnail" width="180">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label><i class="fe fe-check-circle"></i> Status *</label>
                                <select name="status" class="form-control form-control-lg" required>
                                    <option value="ACTIVE" {{ old('status', $product->status ?? '') === 'ACTIVE' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="INACTIVE" {{ old('status', $product->status ?? '') === 'INACTIVE' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fe {{ isset($product) ? 'fe-save' : 'fe-plus' }}"></i>
                                {{ isset($product) ? 'Update Product' : 'Create Product' }}
                            </button>

                            <a href="{{ route('backend.products.index') }}" class="btn btn-secondary btn-lg ml-2">
                                <i class="fe fe-arrow-left"></i> Back
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
