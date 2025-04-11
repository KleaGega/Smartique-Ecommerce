<!-- Edit profile view of user -->
@extends('user.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Profile</h5>
        <a href="/profile/{{ $user->id }}" class="btn btn-outline-primary btn-sm">
            <i class="icofont-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>
    <div class="card-body">
        @include('general.layouts.messages')
        <form action="/profile/{{ $user->id }}/update" method="post">
            <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
            <div class="row g-3">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="icofont-info-circle"></i> Update your personal information below
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">
                            <span class="bg-light p-2 rounded-circle me-2">
                                <i class="icofont-user text-primary"></i>
                            </span>
                            Username
                        </label>
                        <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fullname" class="form-label">
                            <span class="bg-light p-2 rounded-circle me-2">
                                <i class="icofont-user-alt-7 text-primary"></i>
                            </span>
                            Full Name
                        </label>
                        <input type="text" id="fullname" name="fullname" class="form-control" value="{{ $user->fullname }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label">
                            <span class="bg-light p-2 rounded-circle me-2">
                                <i class="icofont-ui-touch-phone text-primary"></i>
                            </span>
                            Phone Number
                        </label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="address" class="form-label">
                            <span class="bg-light p-2 rounded-circle me-2">
                                <i class="icofont-location-pin text-primary"></i>
                            </span>
                            Address
                        </label>
                        <textarea id="address" name="address" rows="3" class="form-control">{{ $user->address }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="city" class="form-label">
                            <span class="bg-light p-2 rounded-circle me-2">
                                <i class="icofont-building-alt text-primary"></i>
                            </span>
                            City
                        </label>
                        <input type="text" id="city" name="city" class="form-control" value="{{ $user->city }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="postal_code" class="form-label">
                        <span class="bg-light p-2 rounded-circle me-3">
                            <i class="icofont-location-pin text-primary"></i>
                        </span>
                            Postal Code
                        </label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ $user->postal_code }}">
                    </div>
                </div>
                <div class="col-12 d-flex">
                    <button type="submit" class="btn btn-primary me-2">
                        Save Changes
                    </button>
                    <a href="/profile" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
