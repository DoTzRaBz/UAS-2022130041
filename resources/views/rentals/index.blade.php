@extends('layouts.app')

@section('title', 'Rentals')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Rentals</h2>
            <a href="{{ route('rentals.create') }}" class="btn btn-primary">New Rental</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Film</th>
                            <th>Rental Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th>Rental Fee</th>
                            <th>Late Fee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $rental)
                        @if($rental->status !== 'returned')
                        <tr>
                            <td>
                                @if($rental->customer->photo)
                                    <img src="{{ asset('storage/' . $rental->customer->photo) }}"
                                         alt="{{ $rental->customer->name }}"
                                         style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                                @endif
                                {{ $rental->customer->name }}
                            </td>
                            <td>
                                @if($rental->film->poster)
                                    <img src="{{ asset('storage/' . $rental->film->poster) }}" ```blade
                                         alt="{{ $rental->film->title }}"
                                         style="width: 30px; height: 40px; margin-right: 5px;">
                                @endif
                                {{ $rental->film->title }}
                            </td>
                            <td>{{ $rental->rental_date->format('Y-m-d') }}</td>
                            <td>{{ $rental->return_date->format('Y-m-d') }}</td>
                            <td>
                                <span class="badge bg-{{ $rental->status === 'ongoing' ? 'primary' : ($rental->status === 'returned' ? 'success' : 'danger') }}">
                                    {{ $rental->status }}
                                </span>
                            </td>
                            <td>${{ number_format($rental->rental_fee, 2) }}</td>
                            <td>${{ number_format($rental->late_fee ?? 0, 2) }}</td>
                            <td>
                                @if($rental->status === 'ongoing')
                                <form action="{{ route('rentals.return', $rental) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Return Film & Mark as Paid</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
