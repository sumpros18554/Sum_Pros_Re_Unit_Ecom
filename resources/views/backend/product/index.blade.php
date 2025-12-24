@extends('backend.layout.master')

@section('title', 'Product List')

@section('content')

@extends('backend.layout.master')

@section('title', 'Product List')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row">
                    <div class="col-md-12 my-4">
                        <h2 class="h4 mb-1">Products</h2>
                        <p class="mb-4">Manage your products, add new items, and edit existing ones.</p>
                        <div class="card shadow">
                            <div class="card-body">

                                <!-- Toolbar -->
                                <div class="toolbar row mb-3">
                                    <div class="col">
                                        <form class="form-inline">
                                            <div class="form-row">
                                                <div class="form-group col-auto">
                                                    <label for="search" class="sr-only">Search</label>
                                                    <input type="text" class="form-control" id="search"
                                                        placeholder="Search Products">
                                                </div>
                                                <div class="form-group col-auto ml-3">
                                                    <label class="sr-only" for="statusFilter">Status</label>
                                                    <select class="custom-select" id="statusFilter">
                                                        <option selected>All Status</option>
                                                        <option value="ACTIVE">Active</option>
                                                        <option value="INACTIVE">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col ml-auto">
                                        <!-- Create Button with icon -->
                                        <a href="{{ route('backend.products.create') }}" class="btn btn-success float-right ml-3">
                                            <i class="fe fe-plus"></i> Create
                                        </a>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($products as $product)
                                            <tr>
                                                <td>{{ $product->product_id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <span class="badge {{ $product->status === 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $product->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Edit button with icon -->
                                                    <a href="{{ route('backend.products.edit', $product->product_id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fe fe-edit"></i> Edit
                                                    </a>
                                                    <!-- Delete button with icon -->
                                                    <form action="{{ route('backend.products.destroy', $product->product_id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="fe fe-trash-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No products found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection

