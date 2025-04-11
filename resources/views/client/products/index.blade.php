<!-- Products view page -->
@extends('client.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container-fluid my-4">
        <div class="row p-4">
            <div class="col-12 mb-4 text-md-center">
                <h1 class="fw-bold position-relative d-inline-block pb-2">
                    Smartique products
                    <span class="position-absolute start-0 bottom-0" style="height: 3px; width: 60%; background-color: #0d6efd;"></span>
                </h1>
                <p class="text-muted mt-2">Discover our premium collection of high-quality products</p>
            </div>

            <div class="col-12 mb-4 text-end">
            <form method="GET" action="{{ '/products' }}" class="d-inline-block">
                @if(isset($q) && !empty($q))
                    <input type="hidden" name="key" value="{{ $q }}">
                @endif
                <label for="sort" class="me-2 fw-semibold">Sort by price:</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                    <option value="">-- Select --</option>
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Lowest to Highest</option>
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Highest to Lowest</option>
                </select>
            </form>
        </div>
        <div class="container py-5">
            <div class="row g-4">
                @foreach ($products as $product)
                    @include('client.layouts.single_product')
                @endforeach
            </div>
        </div>
            <div class="d-flex justify-content-center mt-4">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection