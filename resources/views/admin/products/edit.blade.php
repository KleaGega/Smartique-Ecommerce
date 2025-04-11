<!-- Edit product view in admin -->
```blade
@extends('admin.layouts.app')
@section('title', 'Edit Product')
@section('content')

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="display-5 fw-normal mb-2">Edit Product</h2>
            <p class="text-muted">Update the form below with your product details</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5 text-sm">
                    @include('admin.layouts.messages')
                    <form action="/admin/products/{{$product->id}}/update/" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="h6 form-control form-control-lg border-0 bg-light" value="{{$product->name}}" placeholder="Enter product name" required>
                            <div class="form-text">Choose a clear, descriptive name for your product</div>
                        </div>
                        <div class="col-md-6 mb-4 w-100">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light">$</span>
                                <input type="number" name="price" class="form-control border-0 bg-light" value="{{$product->price}}" placeholder="0.00" step="0.01" required>
                            </div>
                        </div>  
                        <div class="col-md-6 mb-4 w-100">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control border-0 bg-light" value="{{$product->quantity}}" placeholder="0" required>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-select border-0 bg-light" required>
                                <option value="" disabled>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control border-0 bg-light" rows="5" placeholder="Describe your product in detail" required>{{$product->description}}</textarea>
                            <div class="form-text">Include key features and benefits that will appeal to customers</div>
                        </div>
                        <div class="mb-5">
                            <label for="image" class="form-label">Product Image</label>
                            <div class="bg-light p-3 rounded mb-2 text-center">
                                <small class="text-muted d-block mb-2">Upload a high-quality product image</small>
                                <input type="file" name="image" class="form-control border-0" accept="image/*">
                                <small class="form-text">Leave empty to keep current image</small>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3">Update Product</button>
                            <a href="/admin/products" class="btn btn-link text-muted">Cancel and return to products</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
```