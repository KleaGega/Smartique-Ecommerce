<!-- User Distribution View in admin -->
@extends('admin.layouts.app')

@section('title', 'User Distribution')

@section('content')
    <div class="container-fluid px-lg-4 px-2">
        <h1 class="text-center my-4 fs-2 fs-md-1">User Distribution by City</h1>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Users by City</h5>
            </div>
            <div class="card-body p-0 p-md-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mb-0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="align-middle">City</th>
                                <th class="align-middle text-center">Number of Users</th>
                                <th class="align-middle">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalUsers = $usersByCity->sum('total'); @endphp
                            @foreach ($usersByCity as $cityData)
                                <tr>
                                    <td class="align-middle">{{ $cityData->city ?: 'Unknown' }}</td>
                                    <td class="text-center align-middle">{{ $cityData->total }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2 text-nowrap">{{ number_format(($cityData->total / $totalUsers) * 100, 1) }}%</span>
                                            <div class="progress flex-grow-1">
                                                <div class="progress-bar bg-primary" role="progressbar" 
                                                    style="width: {{ ($cityData->total / $totalUsers) * 100 }}%" 
                                                    aria-valuenow="{{ $cityData->total }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="{{ $totalUsers }}">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-dark fw-bold">
                                <th>Total</th>
                                <th class="text-center">{{ $totalUsers }}</th>
                                <th>100%</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection