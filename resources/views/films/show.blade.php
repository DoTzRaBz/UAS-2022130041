@extends('layouts.app')

@section('title', $film->title)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Film Details</h2>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $film->title }}</h3>
                <p><strong>Genre:</strong> {{ $film->genre->name }}</p>
                <p><strong>Price:</strong> ${{ number_format($film->price, 2) }}</p>
                <p><strong>Stock:</strong> {{ $film->stock }}</p>
                <a href="{{ route('films.edit', $film) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('films.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
