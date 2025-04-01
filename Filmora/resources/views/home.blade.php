@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="flex flex-col lg:flex-row gap-6 p-6">
    <!-- Bloc de gauche -->
    <div class="bg-gray-900 p-6 rounded-2xl shadow-lg flex-1">
        <h2 class="text-3xl font-bold mb-4">Bienvenue sur Filmora 🎬</h2>
        <p class="text-lg text-gray-200">
            Filmora est une application web interactive pour découvrir, gérer et comparer des films. Tu peux consulter des fiches détaillées, ajouter tes films préférés, et même en comparer plusieurs selon leurs principales caractéristiques.
        </p>
    </div>

    <!-- Bloc de droite -->
    <div class="bg-gray-900 p-6 rounded-2xl shadow-lg flex-1">
        <h3 class="text-2xl font-semibold mb-4">🆕 Derniers films ajoutés</h3>
        <ul class="list-disc list-inside text-white space-y-2">
            @forelse($lastFilms as $film)
                <li>
                    <strong>{{ strtoupper($film->title) }}</strong> ({{ $film->genre }}) – Réalisé par : {{ $film->director }}
                </li>
            @empty
                <li class="text-gray-400">Aucun film ajouté pour l’instant.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
