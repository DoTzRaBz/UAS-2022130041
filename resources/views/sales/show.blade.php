@extends('layouts.app')

@section('title', 'Sale Details')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Sale Details</h2>
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h4>Invoice Information</h4>
                    <p><strong>Invoice Number:</strong> {{ $sale->invoice_number }}</p>
                    <p><strong>Sale Date:</strong> {{ $sale->sale_date->format('Y-m-d') }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($sale->amount, 2) }}</p>
                </div>

                <div class="mb-4">
                    <h4>Customer Information</h4>
                    <p><strong>Name:</strong> {{ $sale->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $sale->customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $sale->customer->phone }}</p>
                    <p><strong>Address:</strong> {{ $sale->customer->address }}</p>
                </div>

                <div class="mb-4">
                    <h4>Film Information</h4>
                    <p><strong>Title:</strong> {{ $sale->film->title }}</p>
                    <p><strong>Genre:</strong> {{ $sale->film->genre->name }}</p>
                    <p><strong>Release Year:</strong> {{ $sale->film->release_year }}</p>
                    <p><strong>Price:</strong> ${{ number_format($sale->film->price, 2) }}</p>
                </div>

                <div class="mt-4">
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back to Sales List</a>

                    <!-- Print Invoice Button -->
                    <a href="{{ route('sales.print', $sale) }}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-print"></i> Print Invoice
                    </a>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Transaction History</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>Sale</td>
                            <td>${{ number_format($sale->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-success">Completed</span>
                            </td>
                        </tr>
                        @if($sale->payments->count() > 0)
                            @foreach($sale->payments as $payment)
                            <tr>
                                <td>{{ $payment->payment_date->format('Y-m-d H:i:s') }}</td>
                                <td>Payment</td>
                                <td>${{ number_format($payment->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-success">Processed</span>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes Section -->
        @if($sale->notes)
        <div class="card mt-4">
            <div class="card-header">
                <h4>Notes</h4>
            </div>
            <div class="card-body">
                <p>{{ $sale->notes }}</p>
            </div>
        </div>
        @endif

        <!-- Attachments Section -->
        @if($sale->attachments->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h4>Attachments</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($sale->attachments as $attachment)
                    <li class="list-group-item">
                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">
                            {{ $attachment->file_name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .badge {
        font-size: 0.9em;
        padding: 0.5em 1em;
    }
    .card-header h4 {
        margin-bottom: 0;
    }
</style>
@endsection
