<!-- Cart View -->
@extends('client.layouts.app')
@section('title', 'Your Shopping Cart')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4 fw-light">Your Shopping Cart</h3>
            @include('client.layouts.messages')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 text-uppercase small text-muted">Item</th>
                                    <th class="px-4 py-3 text-uppercase small text-muted">Price</th>
                                    <th class="px-4 py-3 text-uppercase small text-muted">Quantity</th>
                                    <th class="px-4 py-3 text-uppercase small text-muted">Total</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!is_null($cartItems) && count($cartItems) > 0)
                                @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3">
                                                <img src="/{{ \App\Core\Cart::getProductImage($cartItem['id']) }}" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ \App\Core\Cart::getProductName($cartItem['id']) }}</h6>
                                                <p class="small text-muted mb-0">Product Code: {{ $cartItem['id'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-medium">${{ \App\Core\Cart::getProductPrice($cartItem['id']) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary decrementQty" data-productId="{{ $cartItem['id'] }}">
                                                <i class="icofont icofont-minus"></i>
                                            </button>
                                            <span class="mx-3 fw-medium">{{ $cartItem['quantity'] }}</span>
                                            <button class="btn btn-sm btn-outline-secondary incrementQty" data-productId="{{ $cartItem['id'] }}">
                                                <i class="icofont icofont-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-medium">${{ \App\Core\Cart::getTotalProductPrice($cartItem['id'], $cartItem['quantity']) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="btn btn-sm text-danger remove" data-productId="{{ $cartItem['id'] }}">
                                            <i class="icofont icofont-close"></i> Remove this order
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <h5 class="text-muted fw-light">Your shopping bag is empty</h5>
                                        <a href="/products" class="btn btn-outline-dark mt-3">Continue Shopping</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (!is_null($cartItems) && count($cartItems) > 0)
            <div class="d-flex justify-content-between mt-4">
                <a href="/products" class="btn btn-outline-dark">
                <i class="icofont icofont-arrow-left me-2"></i>Continue Shopping
                </a>
                <button id="removeAll" class="btn btn-outline-danger">
                <i class="icofont icofont-trash me-2"></i>Clear Your Cart
                </button>
            </div>
            @endif
        </div>
        @if (!is_null($cartItems) && count($cartItems) > 0)
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="fw-light mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-medium">${{ \App\Core\Cart::getTotalAmount() }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="fw-medium">0 (free)</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-medium">Estimated Total</span>
                        <span class="fw-bold">${{ \App\Core\Cart::getTotalAmount() }}</span>
                    </div>
                    <form action="/payment/pay/" method="post">
                        <button class="btn btn-dark w-100 py-2" type="submit">
                        Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection