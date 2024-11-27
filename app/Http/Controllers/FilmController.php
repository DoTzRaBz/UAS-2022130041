<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
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
            'genre' => 'required',
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
            'genre' => 'required',
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
