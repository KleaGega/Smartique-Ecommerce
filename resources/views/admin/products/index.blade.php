<!-- View of product in admin -->
@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="bg-light py-4 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold mb-0">Products</h1>
                    <p class="text-muted">Manage your product inventory</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="/admin/products/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        @include('admin.layouts.messages')
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="mb-0">Showing <span class="fw-bold">{{ count($products) }}</span> products</p>
            </div>
        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Product Name</th>
                            <th class="py-3">Price</th>
                            <th class="py-3">Quantity</th>
                            <th class="py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="py-3 align-middle">
                                    <span class="fw-bold">{{$product->name}}</span>
                                </td>
                                <td class="py-3 align-middle">
                                    <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="py-3 align-middle">
                                    @if($product->quantity > 0)
                                        <span class="badge bg-success">{{ $product->quantity }} in stock</span>
                                    @else
                                        <span class="badge bg-danger">Out of stock</span>
                                    @endif
                                </td>
                                <td class="py-3 align-middle text-end">
                                    <div class="d-flex justify-content-end">
                                        <a href="/admin/products/{{ $product->id }}/edit/" class="btn btn-sm btn-outline-primary me-2">
                                            Edit
                                        </a>
                                        <form action="/admin/products/{{ $product->id }}/delete/" method="post">
                                            <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                        @if(count($products) == 0)
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-5">
                                        <i class="bi bi-exclamation-circle display-6 text-muted mb-3"></i>
                                        <h5>No products found</h5>
                                        <p class="text-muted">Try changing your search criteria or add a new product</p>
                                        <a href="/admin/products/create" class="btn btn-primary mt-3">Add Product</a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination flex gap-2">
            {!! $links !!}
        </div>
    </div>
@endsection
