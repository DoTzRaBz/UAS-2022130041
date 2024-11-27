@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark">
    <h1 class="text-white py-4">Film List</h1>
    <a href="{{ route('films.create') }}" class="btn btn-primary">Add New Film</a>
    <div class="row">
        @foreach($films as $film)
        <div class="col-md-2 mb-4">
            <div class="card bg-dark text-white">
                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $film->title }}</h5>
                    <p class="card-text">{{ $film->genre }}</p>

                        <a href="{{ route('films.edit', $film->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #141414;
    }
    .card {
        transition: transform .2s;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-img-top {
        height: 300px;
        object-fit: cover;
    }
</style>
@endpush
