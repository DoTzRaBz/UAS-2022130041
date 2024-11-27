@extends('layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="container">
    <h2>Edit Sale</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sales.update', $sale) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="film_id" class="form-label">Film</label>
                    <select class="form-select @error('film_id') is-invalid @enderror" id="film_id" name="film_id">
                        <option value="">Select Film</option>
                        @foreach($films as $film)
                            <option value="{{ $film->id }}" {{ old('film_id', $sale->film_id) == $film->id ? 'selected' : '' }}>{{ $film->title }}</option>
                        @endforeach
                    </select>
                    @error('film_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $sale->quantity) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                        <option value="pending" {{ old('payment_status', $sale->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('payment_status', $sale->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cancelled" {{ old('payment_status', $sale->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Sale</button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
