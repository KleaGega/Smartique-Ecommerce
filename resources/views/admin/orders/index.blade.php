<!-- Orders View in admin dashboard -->
@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="text-center mb-4">Orders</h1>
        @include('admin.layouts.messages')
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Order Code</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td><span class="d-inline-block text-truncate" style="max-width: 150px;">{{ $order->ref_code }}</span></td>
                            <td>{{ $order->user->username }}</td>
                            <td>${{ $order->total_price }}</td>
                            <td>
                                @if ($order->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->status != 'paid')
                                    <a href="/admin/orders/paid/{{ $order->id }}" class="btn btn-success btn-sm w-100">
                                        Mark as Paid
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm w-100" disabled>Already Paid</button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm w-100" data-bs-toggle="modal"data-bs-target="#orderDetailsModal{{ $order->id }}">
                                    View Details
                                </button>
                                <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Order ID:</strong> {{ $order->id }}</p>
                                                        <p class="mb-1"><strong>User:</strong> {{ $order->user->username }}</p>
                                                        <p class="mb-1"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Reference Code:</strong></p>
                                                        <p class="mb-1"><small class="text-muted">{{ $order->ref_code }}</small></p>
                                                        <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h5 class="mt-3 mb-3">Ordered Items</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->orderItems as $item)
                                                                <tr>
                                                                    <td>{{ $item->product->name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>${{ number_format($item->product->price, 2) }}</td>
                                                                    <td>${{ number_format($item->total_price, 2) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {!! $links !!}
        </div>
    </div>
@endsection