<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
            $genre = $request->query('genre');
            $year = $request->query('year');

            $genres = Genre::all();

            \Illuminate\Support\Facades\DB::enableQueryLog();

            $query = Movie::withh('genre');

            if ($genre) {
                $query = $query->where('genre_id', $genre);
            }

            if ($year) {
                $query = $query->where('year', $year);
            }

            $movies = $query->get();

            return view('movies.index', compact('movies', 'genre', 'year', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:100',
            'genre_id' => 'required|exists:genres,id',
            'rating'   => 'required|numeric|min:0|max:10',
            'year'     => 'required|integer|min:1900|max:2030',
        ]);

        $movie = Movie::create($validated);

        Log::info('Movie saved', [
            'id' => $movie->id,
        ]);
        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie added successfully!');
    }

    public function show(Movie $movie)
    {

        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view ('movies.edit', compact('movie', 'genres'));
        
    }

    public function update(Request $request, Movie $movie)
{
    $validated = $request->validate([
        'title'    => 'required|string|max:100',
        'genre_id' => 'required|exists:genres,id',
        'rating'   => 'required|numeric|min:0|max:10',
        'year'     => 'required|integer|min:1900|max:2030',
    ]);

    $movie->update($validated);

    return redirect()
        ->route('movies.index')
        ->with('success', 'Movie updated successfully!');
}

    public function destroy(Movie $movie)
    {
        abort_if($movie->genre->movies()->count() === 1, 403);

        $movie->delete();

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }


}