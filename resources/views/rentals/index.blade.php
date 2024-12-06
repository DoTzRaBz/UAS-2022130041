@extends('layouts.app')

@section('title', 'Rentals')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="h3 text-gray-800 mb-0">
                <i class="fas fa-film me-2"></i>Film Rentals
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('rentals.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i>New Rental
            </a>
        </div>
    </div>

    {{-- Alert Notifications --}}
    @include('components.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Active Rentals</h6>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th>Customer</th>
                        <th>Film</th>
                        <th>Rental Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Rental Fee</th>
                        <th>Late Fee</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                    @if($rental->status !== 'returned')
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <img src="{{ $rental->customer->photo ? asset('storage/' . $rental->customer->photo) : asset('assets/img/default-avatar.jpg') }}"
                                         alt="{{ $rental->customer->name }}"
                                         class="rounded-circle"
                                         width="40"
                                         height="40">
                                </div>
                                {{ $rental->customer->name }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $rental->film->poster ? asset('storage/' . $rental->film->poster) : asset('assets/img/default-poster.jpg') }}"
                                     alt="{{ $rental->film->title }}"
                                     class="me-2"
                                     width="40"
                                     height="50">
                                {{ $rental->film->title }}
                            </div>
                        </td>
                        <td>{{ $rental->rental_date->format('d M Y') }}</td>
                        <td>{{ $rental->return_date->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{
                                $rental->status === 'ongoing' ? 'primary' :
                                ($rental->status === 'returned' ? 'success' : 'danger')
                            }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                        <td>${{ number_format($rental->rental_fee, 2) }}</td>
                        <td>${{ number_format($rental->late_fee ?? 0, 2) }}</td>
                        <td class="text-center">
                            @if($rental->status === 'ongoing')
                            <form action="{{ route('rentals.return', $rental) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check me-1"></i>Return
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            <i class="fas fa-box-open me-2"></i>No active rentals found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
