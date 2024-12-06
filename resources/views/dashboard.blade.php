@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="card-header" style="background-color: #000; color: white; padding: 4rem;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/film.png') }}" alt="Welcome" class="img-fluid" style="max-width: 100px;">
                        </div>
                        <div>
                            <h1 class="display-6 mb-2">Welcome, {{ Auth::user()->name }}!</h1>
                            <p class="text-white-75 mb-0">
                                Berikut isi Dasbor Film Sewa Anda
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-0 pt-4 pb-0">
                                    <h4 class="card-title text-primary">
                                        <i class="fas fa-bell me-2"></i>Quick Actions
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                        <a href="{{ route('customers.create') }}" class="btn btn-outline-primary me-2">
                                            <i class="fas fa-user-plus me-2"></i>Tambah Customer
                                        </a>
                                        <a href="{{ route('films.create') }}" class="btn btn-outline-success me-2">
                                            <i class="fas fa-film me-2"></i>Tambah Film
                                        </a>
                                        <a href="{{ route('rentals.create') }}" class="btn btn-outline-warning me-2">
                                            <i class="fas fa-cart-plus me-2"></i>Buat Rental
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: #e93535 !important;
        color: rgb(255, 0, 0) !important;
        box-shadow: 0 4px 6px rgba(255, 11, 11, 0.1);
    }
    .btn-outline-primary,
    .btn-outline-success,
    .btn-outline-warning {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    .btn-outline-primary i,
    .btn-outline-success i,
    .btn-outline-warning i {
        margin-right: 8px;
    }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
