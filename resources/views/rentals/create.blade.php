@extends('layouts.app')

@section('title', 'New Rental')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Rental</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('rentals.store') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="customer_id" class="col-md-4 col-form-label text-md-right">Customer</label>
                                <div class="col-md-6">
                                    <select id="customer_id" class="form-control @error('customer_id') is-invalid @enderror"
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
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="film_id" class="col-md-4 col-form-label text-md-right">Film</label>
                                <div class="col-md-6">
                                    <select id="film_id" class="form-control @error('film_id') is-invalid @enderror"
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
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="rental_date" class="col-md-4 col-form-label text-md-right">Rental Date</label>
                                <div class="col-md-6">
                                    <input id="rental_date" type="date"
                                        class="form-control @error('rental_date') is-invalid @enderror" name="rental_date"
                                        value="{{ old('rental_date', date('Y-m-d')) }}" required>
                                    @error('rental_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="return_date" class="col-md-4 col-form-label text-md-right">Return Date</label>
                                <div class="col-md-6">
                                    <input id="return_date" type="date"
                                        class="form-control @error('return_date') is-invalid @enderror" name="return_date"
                                        value="{{ old('return_date', date('Y-m-d', strtotime('+7 days'))) }}" required>
                                    @error('return_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Rental
                                    </button>
                                    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
