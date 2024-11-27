<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:genres|max:255',
            'description' => 'required'
        ]);

        Genre::create($validated);
        return redirect()->route('genres.index')->with('success', 'Genre added successfully');
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:genres,name,' . $genre->id,
            'description' => 'required'
        ]);

        $genre->update($validated);
        return redirect()->route('genres.index')->with('success', 'Genre updated successfully');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully');
    }
}
