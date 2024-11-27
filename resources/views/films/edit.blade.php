@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Edit Film</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('films.update', $film) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $film->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genre_id" class="form-label">Genre</label>
                        <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id">
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
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $film->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $film->stock) }}">
                        @error('stock')
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
