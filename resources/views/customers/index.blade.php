@extends('layouts.app')

@section('title', 'Customers List')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Customers List</h2>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>
                                @if($customer->photo)
                                    <img src="{{ asset('storage/' . $customer->photo) }}" alt="{{ $customer->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
