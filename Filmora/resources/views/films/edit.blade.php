@extends('layouts.app')

@section('title', 'Modifier le film')

@section('content')
    <h2>✏️ Modifier le Film</h2>

    <div class="page-content">
        <form action="{{ route('films.update', $film->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-semibold">Titre</label>
                <input type="text" id="title" name="title" value="{{ old('title', $film->title) }}" required
                       class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="genre" class="block font-semibold">Genre</label>
                <input type="text" id="genre" name="genre" value="{{ old('genre', $film->genre) }}" required
                       class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="year" class="block font-semibold">Année de sortie</label>
                <input type="text" id="year" name="year" value="{{ old('year', $film->year) }}" required
                       class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="duration" class="block font-semibold">Durée (en minutes)</label>
                <input type="number" id="duration" name="duration" value="{{ old('duration', $film->duration) }}" required
                       class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="director" class="block font-semibold">Réalisateur</label>
                <input type="text" id="director" name="director" value="{{ old('director', $film->director) }}" required
                       class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                    💾 Enregistrer
                </button>
                <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded">
                    ⬅️ Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
