@extends('layouts.app')

@section('title', 'Sales Transactions')

@section('content')
    <div class="container-fluid px-4">
        {{-- Sales Summary --}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Customers
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalCustomers }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Revenue
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Sales
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalSales }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Average Revenue
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($averageRevenue, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            {{-- Tambahkan kartu statistik lainnya --}}
        </div>

        {{-- Filter dan Search --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ route('sales.index') }}" method="GET">
                    <div class="row">
                        {{-- Search Input --}}
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search customer, film, price" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Payment Status Filter --}}
                        <div class="col-md-2">
                            <select name="payment_status" class="form-select" onchange="this.form.submit()">
                                <option value="">Payment Status</option>
                                @foreach ($paymentStatuses as $status)
                                    <option value="{{ $status }}"
                                        {{ request('payment_status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sorting --}}
                        <div class="col-md-2">
                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>
                                    Sort by Date
                                </option>
                                <option value="total_price" {{ request('sort') == 'total_price' ? 'selected' : '' }}>
                                    Sort by Price
                                </option>
                                <option value="quantity" {{ request('sort') == 'quantity' ? 'selected' : '' }}>
                                    Sort by Quantity
                                </option>
                            </select>
                        </div>

                        {{-- Sort Direction --}}
                        <div class="col-md-2">
                            <select name="direction" class="form-select" onchange="this.form.submit()">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>
                                    Descending
                                </option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                                    Ascending
                                </option>
                            </select>
                        </div>

                        {{-- Reset Filter --}}
                        <div class="col-md-2">
                            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Penjualan --}}
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Film</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->film->title }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>${{ number_format($sale->total_price, 2) }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $sale->payment_status == 'paid' ? 'success' : ($sale->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($sale->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('sales.show', $sale) }}" class=" btn btn-info btn-sm">View</a>
                                        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('sales.destroy', $sale) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this sale?');">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No sales found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            {{-- Pagination --}}
            <div class="card-footer">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
@endsection
