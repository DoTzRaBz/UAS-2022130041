@extends('layouts.app')

@section('title', 'Create New Sale')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Create New Sale
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-user me-2"></i>Customer
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <select class="form-select @error('customer_id') is-invalid @enderror"
                                            id="customer_id"
                                            name="customer_id"
                                            data-placeholder="Select Customer"
                                            required>
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
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
                        </div>

                        <div class="row mb-3">
                            <label for="film_id" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-film me-2"></i>Film
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-video"></i></span>
                                    <select class="form-select @error('film_id') is-invalid @enderror"
                                            id="film_id"
                                            name="film_id"
                                            data-price-attr="price"
                                            required>
                                        <option value="">Select Film</option>
                                        @foreach($films as $film)
                                            <option value="{{ $film->id }}"
                                                    data-price="{{ $film->price }}"
                                                    {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                                {{ $film->title }} - Rp {{ number_format($film->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('film_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-sort-numeric-up me-2"></i>Quantity
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                    <input type="number"
                                           class="form-control @error('quantity') is-invalid @enderror"
                                           id="quantity"
                                           name="quantity"
                                           value="{{ old('quantity', 1) }}"
                                           min="1"
                                           required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="total_price" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-money-bill-wave me-2"></i>Total Price
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text"
                                           class="form-control"
                                           id="total_price"
                                           name="total_price"
                                           readonly
                                           value="{{ old('total_price') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sale_date" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-calendar-alt me-2"></i>Sale Date
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date"
                                           class="form-control @error('sale_date') is-invalid @enderror"
                                           id="sale_date"
                                           name="sale_date"
                                           value="{{ old('sale_date', date('Y-m-d')) }}"
                                           required>
                                    @error('sale_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Create Sale
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filmSelect = document.getElementById('film_id');
        const quantityInput = document.getElementById('quantity');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotalPrice() {
            const selectedOption = filmSelect.options[filmSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price) || 0;
            const quantity = parseInt(quantityInput.value) || 1;
            const totalPrice = price * quantity;

            totalPriceInput.value = new Intl.NumberFormat('id-ID').format(totalPrice);
        }

        filmSelect.addEventListener('change', calculateTotalPrice);
        quantityInput.addEventListener('input', calculateTotalPrice);

        // Initial calculation
        calculateTotalPrice();
    });
</script>
@endsection
