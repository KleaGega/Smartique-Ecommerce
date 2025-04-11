<!-- Profile Information about user -->
@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User Dashboard</h5>
        <a href="/" class="btn btn-outline-primary btn-sm">
            <i class="icofont-home"></i> Back to Home
        </a>
    </div>
    <div class="card-body">
        @include('general.layouts.messages')
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="icofont-shopping-cart text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="mb-0">My Orders</h6>
                        </div>
                        <h3 class="mb-2">{{ $ordersCount }}</h3>
                        <a href="/profile/{{ $user->id }}/orders" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Profile Information</h5>
                <a href="/profile/{{ $user->id }}/edit" class="btn btn-sm btn-outline-success">
                    <i class="icofont-edit me-1"></i> Edit
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-user text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Username</small>
                                <p class="mb-0 fw-medium">{{ $user->username }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-ui-email text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Email Address</small>
                                <p class="mb-0 fw-medium">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-phone text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Phone number</small>
                                <p class="mb-0 fw-medium">{{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-home text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Shipping Address</small>
                                <p class="mb-0 fw-medium">{{ $user->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-building text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Shipping City</small>
                                <p class="mb-0 fw-medium">{{ $user->city }}</p>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="bg-light p-2 rounded-circle me-3">
                                <i class="icofont-location-pin text-primary"></i>
                            </span>
                            <div>
                                <small class="text-muted">Postal Code</small>
                                <p class="mb-0 fw-medium">{{ $user->postal_code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection