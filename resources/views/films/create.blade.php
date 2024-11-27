@extends('layouts.app')

@section('title', 'Add New Film')

@section('content')
<div class="container">
    <h1>Add New Film</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select class="form-control" id="genre" name="genre" required>
                <option value="">Select Genre</option>
                <option value="Action">Action</option>
                <option value="Comedy">Comedy</option>
                <option value="Drama">Drama</option>
                <option value="Horror">Horror</option>
                <option value="Sci-Fi">Sci-Fi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="director" class="form-label">Director</label>
            <input type="text" class="form-control" id="director" name="director" value="{{ old('director') }}" required>
        </div>

        <div class="mb-3">
            <label for="release_year" class="form-label">Release Year</label>
            <input type="number" class="form-control" id="release_year" name="release_year" value="{{ old('release_year') }}" required>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" step="0.1" class="form-control" id="rating" name="rating" value="{{ old('rating') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="rental_price" class="form-label">Rental Price</label>
            <input type="number" step="0.01" class="form-control" id="rental_price" name="rental_price" value="{{ old('rental_price') }}" required>
        </div>

        <div class="mb-3">
            <label for="poster" class="form-label">Poster</label>
            <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save Film</button>
        <a href="{{ route('films.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
