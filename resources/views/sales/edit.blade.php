@extends('layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Edit Sale
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.update', $sale) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-user me-2"></i>Customer
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('customer_id') is-invalid @enderror"
                                        id="customer_id"
                                        name="customer_id"
                                        required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="film_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-film me-2"></i>Film
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('film_id') is-invalid @enderror"
                                        id="film_id"
                                        name="film_id"
                                        required>
                                    <option value="">Select Film</option>
                                    @foreach($films as $film)
                                        <option value="{{ $film->id }}"
                                            {{ old('film_id', $sale->film_id) == $film->id ? 'selected' : '' }}>
                                            {{ $film->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('film_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-sort-numeric-up me-2"></i>Quantity
                            </label>
                            <div class="col-md-6">
                                <input type="number"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity"
                                       name="quantity"
                                       value="{{ old('quantity', $sale->quantity) }}"
                                       min="1"
                                       required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="payment_status" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-money-check-alt me-2"></i>Payment Status
                            </label>
                            <div class="col-md-6">
                                <select class="form-select @error('payment_status') is-invalid @enderror"
                                        id="payment_status"
                                        name="payment_status"
                                        required>
                                    <option value="pending" {{ old('payment_status', $sale->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ old('payment_status', $sale->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="cancelled" {{ old('payment_status', $sale->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md- 6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Sale
                                </button>
                                <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
