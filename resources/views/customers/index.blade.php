@extends('layouts.app')

@section('title', 'Customers List')

@section('styles')
    <style>
        .customer-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .customer-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .customer-avatar {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="display-6 text-primary">Customer Management</h1>
                <a href="{{ route('customers.create') }}" class="btn btn-primary btn-lg shadow">
                    <i class="fas fa-plus-circle me-2"></i>Add New Customer
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($customers as $customer)
                <div class="col-md-4 mb-4">
                    <div class="card customer-card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-4">
                                @if ($customer->photo)
                                    <img src="{{ asset('storage/' . $customer->photo) }}" alt="{{ $customer->name }}"
                                        class="customer-avatar">
                                @else
                                    <img src="{{ asset('assets/img/default-avatar.jpg') }}" alt="Default Avatar"
                                        class="customer-avatar">
                                @endif
                            </div>
                            <div>
                                <h5 class="card-title mb-1">{{ $customer->name }}</h5>
                                <p class="card-text text-muted mb-1">
                                    <i class="fas fa-envelope me-2"></i>{{ $customer->email }}
                                </p>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-phone me-2"></i>{{ $customer->phone }}
                                </p>
                                <div class="d-flex">
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
