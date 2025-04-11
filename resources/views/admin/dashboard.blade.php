<!-- Dashboard View -->
@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Dashboard</h1>
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>

<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Products</h6>
                        <h2 class="mb-0">{{ \App\Models\Product::count() }}</h2>
                    </div>
                    <div>
                        <i class="icofont icofont-food-basket fs-1"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/admin/products" class="text-white text-decoration-none">View details <i class="icofont icofont-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Categories</h6>
                        <h2 class="mb-0">{{ \App\Models\Category::count() }}</h2>
                    </div>
                    <div>
                        <i class="icofont icofont-slack fs-1"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/admin/categories" class="text-white text-decoration-none">View details <i class="icofont icofont-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Users</h6>
                        <h2 class="mb-0">{{ \App\Models\User::count() }}</h2>
                    </div>
                    <div>
                        <i class="icofont icofont-users fs-1"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/admin/users" class="text-white text-decoration-none">View details <i class="icofont icofont-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Orders</h6>
                        <h2 class="mb-0">{{ $ordersCount }}</h2>
                    </div>
                    <div>
                        <i class="icofont icofont-basket fs-1"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/admin/orders" class="text-white text-decoration-none">View details <i class="icofont icofont-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Products</h5>
                    <a href="/admin/products" class="btn btn-sm btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @if(count($recentProducts) > 0)
                                @foreach($recentProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No products found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="/admin/orders" class="btn btn-sm btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentOrders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
                            @endphp
                            
                            @if(count($recentOrders) > 0)
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->username }}</td>
                                    <td>${{ $order->total_price }}</td>
                                    <td>
                                        @if($order->status == 'paid')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge bg-warning">Processing</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No orders found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Distribution by City</h5>
                </div>
                <div class="card-body">
                    @if(isset($ordersByCity) && $ordersByCity->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Number of Orders</th>
                                        <th>Percentage</th>
                                        <th>Visualization</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalOrders = $ordersByCity->sum('total');
                                        $counter = 1;
                                    @endphp
                                    
                                    @foreach($ordersByCity as $cityData)
                                        @php
                                            $percentage = round(($cityData->total / $totalOrders) * 100, 1);
                                            $barColor = 'bg-primary';
                                            
                                            if ($percentage > 30) $barColor = 'bg-danger';
                                            elseif ($percentage > 20) $barColor = 'bg-warning';
                                            elseif ($percentage > 10) $barColor = 'bg-success';
                                        @endphp
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td><strong>{{ $cityData->city ?: 'Unknown' }}</strong></td>
                                            <td>{{ number_format($cityData->total) }}</td>
                                            <td>{{ $percentage }}%</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar {{ $barColor }}" role="progressbar" 
                                                         style="width: {{ $percentage }}%;" 
                                                         aria-valuenow="{{ $percentage }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ $percentage }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <td colspan="2"><strong>Total</strong></td>
                                        <td><strong>{{ number_format($totalOrders) }}</strong></td>
                                        <td colspan="2">100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle me-2"></i> No order data available for distribution analysis.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <a href="/admin/products/create" class="btn btn-outline-primary w-100 py-3">
                            <i class="icofont icofont-plus-circle fs-4 d-block mb-2"></i>
                            Add Product
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="/admin/orders" class="btn btn-outline-success w-100 py-3">
                            <i class="icofont icofont-paper fs-4 d-block mb-2"></i>
                            View Orders
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="/admin/categories" class="btn btn-outline-danger w-100 py-3">
                            <i class="icofont icofont-plus-circle fs-4 d-block mb-2"></i>
                            Add Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection