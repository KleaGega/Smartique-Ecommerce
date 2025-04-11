<!-- Users View in admin -->
@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <h1 class="text-center mt-2">Users</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Postal code</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->postal_code }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"data-bs-target="#model{{ $user->id }}">
                                   Details
                                </button>
                                <div class="modal fade" id="model{{ $user->id }}" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">{{ $user->fullname }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <strong>Email: </strong> {{ $user->email }} <br>
                                                <strong>Username:</strong> {{ $user->username }} <br>
                                                <strong>Phone number:</strong> {{ $user->phone }} <br>
                                                <strong>City:</strong> {{ $user->city }} <br>
                                                <strong>Address:</strong> {{ $user->address }}<br>
                                                <strong>Postal code:</strong> {{ $user->postal_code }} <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">close</button>
                                                <form action="/admin/users/{{ $user->id }}/delete/" method="POST">
                                                    <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }" type="submit" value="delete" class="btn btn-outline-danger btn-sm">
                                                </form>
                                                <a href="/admin/users/{{ $user->id }}/edit" class="btn  btn-sm btn-outline-success">edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection
