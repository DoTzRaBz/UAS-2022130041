@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Edit Film</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $film->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genre_id" class="form-label">Genre</label>
                        <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id" required>
                            <option value="">Select Genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id', $film->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="director" class="form-label">Director</label>
                        <input type="text" class="form-control @error('director') is-invalid @enderror" id="director" name="director" value="{{ old('director', $film->director) }}" required>
                        @error('director')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="release_year" class="form-label">Release Year</label>
                        <input type="number" class="form-control @error('release_year') is-invalid @enderror" id="release_year" name="release_year" value="{{ old('release_year', $film->release_year) }}" required>
                        @error('release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating', $film->rating) }}" required>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $film->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $film->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rental_price" class="form-label">Rental Price</label>
                        <input type="number" step="0.01" class="form-control @error('rental_price') is-invalid @enderror" id="rental_price" name="rental_price" value="{{ old('rental_price', $film->rental_price) }}" required>
                        @error('rental_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $film->stock) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" class="form-control @error('poster') is-invalid @enderror" id="poster" name="poster" accept="image/*">
                        @if($film->poster)
                            <small class="text-muted">Current poster: {{ basename($film->poster) }}</small>
                        @endif
                        @error('poster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Film</button>
                    <a href="{{ route('films.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
