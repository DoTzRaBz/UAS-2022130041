<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
{
    $query = Film::query();

    // Search functionality
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('release_year', 'like', "%{$search}%")
              ->orWhereHas('genre', function($genre) use ($search) {
                  $genre->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Genre filter
    if ($request->has('genre') && $request->input('genre')) {
        $query->where('genre_id', $request->input('genre'));
    }

    // Sorting
    switch ($request->input('sort')) {
        case 'rating':
            $query->orderBy('rating', 'desc');
            break;
        case 'title':
            $query->orderBy('title', 'asc');
            break;
        case 'release_year':
            $query->orderBy('release_year', 'desc');
            break;
        case 'price':
            $query->orderBy('price', 'asc');
            break;
        default:
            $query->latest();
            break;
    }

    // Fetch genres for dropdown
    $genres = Genre::all();

    // Paginate results
    $films = $query->with('genre')->paginate(10);

    return view('films.index', compact('films', 'genres'));
}
  public function create()
    {
        $genres = Genre::all();

        return view('films.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'genre_id' => 'required|exists:genres,id',
            'director' => 'required|max:255',
            'release_year' => 'required|integer',
            'rating' => 'required|numeric|between:0,10',
            'description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'rental_price' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validatedData['poster'] = $posterPath;
        }

        Film::create($validatedData);

        return redirect()->route('films.index')->with('success', 'Film added successfully.');
    }
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('films.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'genre_id' => 'required|exists:genres,id',
            'director' => 'required|max:255',
            'release_year' => 'required|numeric',
            'rating' => 'required|numeric|between:0,10',
            'description' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'rental_price' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('poster')) {
            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path;
        }

        $film->update($validated);
        return redirect()->route('films.index')->with('success', 'Film updated successfully');
    }
    public function destroy(Film $film)
    {
        if ($film->cover_image) {
            Storage::disk('public')->delete($film->cover_image);
        }
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film deleted successfully');
    }
}
