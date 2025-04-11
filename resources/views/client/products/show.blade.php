@extends('client.layouts.app')
@section('title', $product->name)
@section('content')
@include('admin.layouts.messages')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <div class="position-relative mb-3">
                <div class="product-badge position-absolute" style="top: 15px; left: 15px; z-index: 10;">
                </div>
                <div class="product-image-container rounded-4 overflow-hidden shadow" style="height: 450px;">
                    <img src="/{{ $product->image_path }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100"  style="object-fit: cover; transition: transform 0.6s ease;">
                    <div class="product-image-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex justify-content-center align-items-center opacity-0" style="transition: all 0.4s ease; cursor: pointer;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 ps-md-5">
            <div class="mb-2">
                <span class="text-uppercase text-primary fw-bold" style="letter-spacing: 1.5px; font-size: 0.85rem;">Smartique Collection</span>
            </div>
            <h1 class="product-title fw-bold mb-3" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; line-height: 1.2;">
                {{ $product->name }}
            </h1>
            <div class="product-description mb-4" style="font-size: 1.05rem; color: #444; line-height: 1.6;">
                {!! $product->description !!}
            </div>
            <div class="product-attributes mb-4">
                <div class="row">
                    <div class="col-auto">
                        <span class="d-block text-muted mb-1">Availability</span>
                        <span class="fw-bold {{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->quantity > 0 ? 'In Stock (' . $product->quantity . ')' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold text-danger mb-0" style="font-size: 2.25rem;">${{ $product->price }}</h2>
                
                @if($product->old_price ?? false)
                <span class="ms-3 text-decoration-line-through text-muted">${{ $product->old_price }}</span>
                <span class="ms-2 badge bg-danger">Save {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                @endif

            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="me-3">
                    <div class="input-group input-group-lg" style="width: 130px;">
                        <button class="btn btn-outline-secondary" type="button" id="decrease-qty">
                           -
                        </button>
                        <input type="text" class="form-control text-center" id="quantity" name="quantity" value="1" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="increase-qty">
                            +
                        </button>
                    </div>
                </div>

                @if ($product->quantity > 0)
                <button class="btn btn-primary btn-lg px-4 addCart" data-productId="{{ $product->id }}"
                    style="background: linear-gradient(135deg, #2568ef, #0950d0); border: none; box-shadow: 0 4px 15px rgba(37, 104, 239, 0.2); transition: all 0.3s ease;">
                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                </button>
                @else
                <button class="btn btn-danger btn-lg px-4" disabled>
                    <i class="fas fa-times-circle me-2"></i> Out of Stock
                </button>
                @endif
                
            </div>
            <div class="mt-4 d-flex align-items-center">
                <div class="d-flex align-items-center me-4">
                    <i class="fas fa-truck text-primary me-2"></i>
                    <span>Free shipping</span>
                </div>
                <div class="d-flex align-items-center me-4">
                    <i class="fas fa-exchange-alt text-primary me-2"></i>
                    <span>30-day returns</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-shield-alt text-primary me-2"></i>
                    <span>2-year warranty</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 pb-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold position-relative d-inline-block pb-2">
                Similar Products
                <span class="position-absolute start-0 bottom-0 w-50" style="height: 3px; background-color: #0d6efd;"></span>
            </h2>
        </div>
    </div>
    
    <div class="row g-4">
        @foreach ($similarProducts as $product)
            @include('client.layouts.single_product')
        @endforeach
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productImage = document.querySelector('.product-image-container img');
    const overlay = document.querySelector('.product-image-overlay');
    
    if (productImage && overlay) {
        productImage.parentElement.addEventListener('mouseenter', function() {
            productImage.style.transform = 'scale(1.05)';
            overlay.classList.add('opacity-100');
            overlay.classList.remove('opacity-0');
        });
        
        productImage.parentElement.addEventListener('mouseleave', function() {
            productImage.style.transform = 'scale(1)';
            overlay.classList.add('opacity-0');
            overlay.classList.remove('opacity-100');
        });
    }
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    
    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    }
    const addToCartBtn = document.querySelector('.addCart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 15px rgba(37, 104, 239, 0.3)';
        });
        
        addToCartBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 15px rgba(37, 104, 239, 0.2)';
        });
    }
});
</script>
@endsection