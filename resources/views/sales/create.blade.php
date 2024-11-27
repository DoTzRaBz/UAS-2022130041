@extends('layouts.app')

@section('title', 'Create New Sale')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Create New Sale</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
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
                                <option value="{{ $film->id }}" data-price="{{ $film->price }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>{{ $film->title }}</option>
                            @endforeach
                        </select>
                        @error('film_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sale_date" class="form-label">Sale Date</label>
                        <input type="date" class="form-control @error('sale_date') is-invalid @enderror" id="sale_date" name="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}">
                        @error('sale_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Sale</button>
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('film_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.dataset.price;
        document.getElementById('amount').value = price || '';
    });
</script>
@endsection
