@extends('layouts.app')

@section('title', $customer->name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Customer Details</h2>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $customer->name }}</h3>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p><strong>Address:</strong> {{ $customer->address }}</p>
                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

        <h3 class="mt-4">Rental History</h3>
        <div class="card mt-2">
            <div class="card-body">
                @if($customer->rentals->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Rental Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->rentals as $rental)
                            <tr>
                                <td>{{ $rental->film->title }}</td>
                                <td>{{ $rental->rental_date->format('Y-m-d') }}</td>
                                <td>{{ $rental->return_date ? $rental->return_date->format('Y-m-d') : 'Not returned' }}</td>
                                <td>{{ $rental->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No rental history found for this customer.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
