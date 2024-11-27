@extends('layouts.app')

@section('title', 'Sales List')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Sales List</h2>
            <a href="{{ route('sales.create') }}" class="btn btn-primary">Create New Sale</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer</th>
                            <th>Film</th>
                            <th>Total Price</th>
                            <th>Sale Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>INV-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                @if($sale->customer->photo)
                                    <img src="{{ asset('storage/' . $sale->customer->photo) }}"
                                         alt="{{ $sale->customer->name }}"
                                         style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                @endif
                                {{ $sale->customer->name }}
                            </td>
                            <td>
                                @if($sale->film->poster)
                                    <img src="{{ asset('storage/' . $sale->film->poster) }}"
                                         alt="{{ $sale->film->title }}"
                                         style="width: 30px; height: 40px; margin-right: 5px;">
                                @endif
                                {{ $sale->film->title }}
                            </td>
                            <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <span class="badge bg-{{ $sale->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($sale->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @if($sale->payment_status !== 'paid')
                                        <form action="{{ route('sales.updatePaymentStatus', $sale) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="payment_status" value="paid">
                                            <button type="submit" class="btn btn-sm btn-success">Mark as Paid</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this sale?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <h3>Sales Summary</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Customers</h5>
                            <p class="card-text display-4">{{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text display-4">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text display-4">{{ $totalSales }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Average Revenue</h5>
                            <p class="card-text display-4">Rp {{ number_format($averageRevenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
