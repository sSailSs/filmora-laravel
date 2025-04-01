<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Film::query();

        // Si un filtre par genre est appliqué
        if ($request->has('genre') && $request->genre !== '') {
            $query->where('genre', $request->genre);
        }

        $films = $query->get();

        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter un film.');
        }

        return view('films.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', 'not_regex:/(grosmot|insulte|trucméchant)/i'],
            'genre' => ['required', 'string', 'max:30'],
            'year' => ['required', 'integer', 'min:1880', 'max:' . date('Y')], // on limite entre 1880 et aujourd'hui
            'duration' => ['required', 'integer', 'min:1', 'max:600'], // en minutes
            'director' => ['required', 'string', 'max:50'],
        ], [
            'title.required' => 'Le titre du film est obligatoire.',
            'title.max' => 'Le titre ne doit pas dépasser 50 caractères.',
            'title.not_regex' => 'Le titre contient des mots inappropriés.',

            'genre.required' => 'Le genre du film est obligatoire.',
            'genre.max' => 'Le genre ne doit pas dépasser 30 caractères.',

            'year.required' => 'L’année de sortie est obligatoire.',
            'year.integer' => 'L’année doit être un nombre entier.',
            'year.min' => 'L’année semble trop ancienne...',
            'year.max' => 'L’année ne peut pas être dans le futur.',

            'duration.required' => 'La durée est obligatoire.',
            'duration.integer' => 'La durée doit être un nombre entier (en minutes).',
            'duration.min' => 'La durée doit être d’au moins 1 minute.',
            'duration.max' => 'La durée ne doit pas dépasser 600 minutes (10 heures).',

            'director.required' => 'Le nom du réalisateur est obligatoire.',
            'director.max' => 'Le nom du réalisateur ne doit pas dépasser 50 caractères.',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter un film.');
        }

        Film::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'year' => $request->year,
            'duration' => $request->duration,
            'director' => $request->director,
            'user_id' => Auth::id(),
        ]);
        
        return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', 'not_regex:/(grosmot|insulte|trucméchant)/i'],
            'genre' => ['required', 'string', 'max:30'],
            'year' => ['required', 'integer', 'min:1880', 'max:' . date('Y')],
            'duration' => ['required', 'integer', 'min:1', 'max:600'],
            'director' => ['required', 'string', 'max:50'],
        ]);

        $film->update([
            'title' => $request->title,
            'genre' => $request->genre,
            'year' => $request->year,
            'duration' => $request->duration,
            'director' => $request->director,
        ]);

        return redirect()->route('dashboard')->with('success', 'Film mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('dashboard')->with('success', 'Film supprimé avec succès.');
    }

    /**
     * Compare two or more selected films.
     */
    public function compare(Request $request)
    {
        $filmIds = $request->input('films', []);

        if (count($filmIds) < 2) {
            return redirect()->route('films.index')->with('error', 'Sélectionne au moins deux films à comparer.');
        }

        $selectedFilms = Film::whereIn('id', $filmIds)->get();

        return view('films.compare', compact('selectedFilms'));
    }
}
