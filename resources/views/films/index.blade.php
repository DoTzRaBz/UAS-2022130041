@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark text-white py-4">
    {{-- Search and Filter Section --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('films.index') }}" method="GET" class="d-flex">
                <div class="input-group me-2">
                    <span class="input-group-text bg-secondary text-white border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                           name="search"
                           class="form-control bg-secondary text-white border-0"
                           placeholder="Search films by title..."
                           value="{{ request('search') }}">
                </div>

                <div class="input-group me-2" style="max-width: 250px;">
                    <span class="input-group-text bg-secondary text-white border-0">
                        <i class="fas fa-filter"></i>
                    </span>
                    <select name="genre" class="form-select bg-secondary text-white border-0">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}"
                                    {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group" style="max-width: 200px;">
                    <span class="input-group-text bg-secondary text-white border-0">
                        <i class="fas fa-sort"></i>
                    </span>
                    <select name="sort" class="form-select bg-secondary text-white border-0">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-light ms-2">
                    <i class="fas fa-filter me-2"></i>Apply
                </button>

                @if(request('search') || request('genre') || request('sort'))
                    <a href="{{ route('films.index') }}" class="btn btn-outline-danger ms-2">
                        <i class="fas fa-times me-2"></i>Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5">
            Film Library
            @if(request('search'))
                <small class="text-muted">Search: "{{ request('search') }}"</small>
            @endif
            @if(request('genre'))
                <small class="text-muted">Genre: {{ $genres->firstWhere('id', request('genre'))->name }}</small>
            @endif
        </h1>
        <a href="{{ route('films.create') }}" class="btn btn-outline-light d-flex align-items-center">
            <i class="fas fa-plus-circle me-2"></i> Add New Film
        </a>
    </div>

    @if($films->isEmpty())
        <div class="alert alert-secondary text-center" role="alert">
            <i class="fas fa-film me-2"></i>No films found matching your search criteria.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach($films as $film)
            <div class="col">
                <div class="card h-100 bg-secondary bg-opacity-10 border-0 film-card">
                    <div class="position-relative">
                        <img src="{{ $film->poster ? asset('storage/' . $film->poster) : asset('default-film-poster.jpg') }}"
                             class="card-img-top film-poster"
                             alt="{{ $film->title }}">
                        <div class="film-rating badge bg-danger position-absolute top-0 end-0 m-2">
                            <i class="fas fa-star me-1"></i> {{ number_format($film->rating, 1) }}
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">{{ $film->title }}</h5>
                        <p class="card-text text-muted small mb-2">
                            <i class="fas fa-film me-1"></i> {{ $film->genre->name }}
                        </p>
                        <p class="card-text flex-grow-1">
                            {{ Str::limit($film->description, 100) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="badge bg-info">
                                <i class="fas fa-clock me-1"></i> {{ $film->release_year }}
                            </span>
                            <div class="btn-group" role="group">
                                <a href="{{ route('films.show', $film->id) }}" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('films.edit', $film->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-film"
                                            data-film-title="{{ $film->title }}"
                                            onclick="return confirmDelete(event)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
         {{ $films->appends(request()->query())->links('pagination::bootstrap-4', ['class' => 'pagination-dark']) }}
    </div>
</div>
@endsection

{{-- Previous styles and scripts remain the same --}}
