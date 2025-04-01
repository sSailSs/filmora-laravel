@extends('layouts.app')

@section('title', 'Comparateur de Films')

@section('content')
    <h2>🎬 Comparateur de Films</h2>

    @if(count($selectedFilms) < 2)
        <p class="mt-4 text-muted">Sélectionne au moins deux films pour comparer leurs caractéristiques.</p>
        <a href="{{ route('films.index') }}" class="btn btn-secondary mt-3">⬅ Retour à la liste des films</a>
    @else
        <h3 class="mt-4">🔍 Résultats de la comparaison</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Caractéristiques</th>
                    @foreach($selectedFilms as $film)
                        <th>{{ $film->title }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Genre</td>
                    @foreach($selectedFilms as $film)
                        <td>{{ $film->genre }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Année de sortie</td>
                    @foreach($selectedFilms as $film)
                        <td>{{ $film->year }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Durée (min)</td>
                    @foreach($selectedFilms as $film)
                        <td>{{ $film->duration }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Réalisateur</td>
                    @foreach($selectedFilms as $film)
                        <td>{{ $film->director }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    @endif

    <a href="{{ route('films.index') }}" class="btn btn-secondary mt-3">⬅ Retour à la liste des films</a>
@endsection
