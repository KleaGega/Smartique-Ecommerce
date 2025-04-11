<!-- Users Orders -->
@extends('user.layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">My Orders</h2>
        <a href="/profile" class="btn btn-outline-secondary">
            <i class="icofont-user me-1"></i> Back to Profile
        </a>
    </div>
    @if(count($orders) > 0)
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td><span class="fw-medium">{{ $order->ref_code }}</span></td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'bg-warning',
                                                'processing' => 'bg-info',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                            ][$order->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#orderModal{{ $order->id }}">
                                            <i class="icofont-info-circle me-1"></i> View Details
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p class="mb-0">You haven't placed any orders yet.</p>
        </div>
    @endif
    @foreach ($orders as $order)
        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">
                            Order #{{ $order->ref_code }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                                <p class="mb-1">
                                    <strong>Status:</strong> 
                                    @php
                                        $statusClass = [
                                            'pending' => 'text-warning',
                                            'processing' => 'text-info',
                                            'completed' => 'text-success',
                                            'cancelled' => 'text-danger',
                                        ][$order->status] ?? 'text-secondary';
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p class="mb-1"><strong>Order Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                            </div>
                        </div>
                        
                        <h6 class="border-bottom pb-2 mb-3">Order Items</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">${{ number_format($item->total_price / $item->quantity, 2) }}</td>
                                            <td class="text-end">${{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td class="text-end"><strong>${{ number_format($order->total_price, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection