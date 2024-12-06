@extends('layouts.app')

@section('title', 'New Rental')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-plus-circle me-2"></i>Create New Rental
                    </h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rentals.store') }}">
                        @csrf

                        {{-- Customer Selection --}}
                        <div class="row mb-3">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-user me-2"></i>Customer
                            </label>
                            <div class="col-md-6">
                                <select id="customer_id" class="form-select @error('customer_id') is-invalid @enderror"
                                        name="customer_id" required>
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Film Selection --}}
                        <div class="row mb-3">
                            <label for="film_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-film me-2"></i>Film
                            </label>
                            <div class="col-md-6">
                                <select id="film_id" class="form-select @error('film_id') is-invalid @enderror"
                                        name="film_id" required>
                                    <option value="">Select Film</option>
                                    @foreach ($films as $film)
                                        <option value="{{ $film->id }}"
                                            {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                            {{ $film->title }} (Stock: {{ $film->stock }})
                                         </option>
                                    @endforeach
                                </select>
                                @error('film_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Rental Date --}}
                        <div class="row mb-3">
                            <label for="rental_date" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-calendar-alt me-2"></i>Rental Date
                            </label>
                            <div class="col-md-6">
                                <input id="rental_date" type="date"
                                       class="form-control @error('rental_date') is-invalid @enderror"
                                       name="rental_date" value="{{ old('rental_date', date('Y-m-d')) }}" required>
                                @error('rental_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Return Date --}}
                        <div class="row mb-3">
                            <label for="return_date" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-calendar-check me-2"></i>Return Date
                            </label>
                            <div class="col-md-6">
                                <input id="return_date" type="date"
                                       class="form-control @error('return_date') is-invalid @enderror"
                                       name="return_date" value="{{ old('return_date', date('Y-m-d', strtotime('+7 days'))) }}" required>
                                @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-1"></i>Create Rental
                                </button>
                                <a href="{{ route('rentals.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times-circle me-1"></i>Cancel
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
