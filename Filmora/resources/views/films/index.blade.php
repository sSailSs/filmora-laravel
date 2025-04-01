@extends('layouts.app')

@section('title', 'Liste des Films')

@section('content')
    <h2>🎬 Liste des Films</h2>

    {{-- 🔍 Barre de recherche par genre --}}
    <form method="GET" action="{{ route('films.index') }}" class="mb-4">
        <label for="genre">Filtrer par genre :</label>
        <select name="genre" onchange="this.form.submit()">
            <option value="">-- Tous les genres --</option>
            <option value="Action" {{ request('genre') == 'action' ? 'selected' : '' }}>Action</option>
            <option value="Drame" {{ request('genre') == 'drame' ? 'selected' : '' }}>Drame</option>
            <option value="Science-fiction" {{ request('genre') == 'science-fiction' ? 'selected' : '' }}>Science-fiction</option>
            <option value="Comédie" {{ request('genre') == 'comédie' ? 'selected' : '' }}>Comédie</option>
            <option value="Animation" {{ request('genre') == 'animation' ? 'selected' : '' }}>Animation</option>
            <option value="Thriller" {{ request('genre') == 'thriller' ? 'selected' : '' }}>Thriller</option>
        </select>
    </form>

    {{-- 📤 Bouton d’ajout --}}
    <div class="page-content">
        <a href="{{ route('films.create') }}" class="btn btn-primary">Ajouter un Film</a>
    </div>

    {{-- 📝 Formulaire de sélection pour comparaison --}}
    <form method="GET" action="{{ route('films.compare') }}">
        <table class="table">
            <thead>
                <tr>
                    <th>Sélection</th>
                    <th>Titre</th>
                    <th>Genre</th>
                    <th>Durée (min)</th>
                    <th>Année</th>
                    <th>Réalisateur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td>
                            <input type="checkbox" name="films[]" value="{{ $film->id }}" class="film-checkbox">
                        </td>
                        <td>{{ $film->title }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->duration }}</td>
                        <td>{{ $film->year }}</td>
                        <td>{{ $film->director }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- 🧪 Bouton de comparaison --}}
        <button type="submit" class="btn btn-warning mt-3" id="compare-btn" disabled>
            🔍 Lancer la comparaison
        </button>
    </form>

    {{-- 💡 Script : Active le bouton si au moins 2 cases sont cochées --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.film-checkbox');
            const compareBtn = document.getElementById('compare-btn');

            function toggleButton() {
                const checkedCount = document.querySelectorAll('.film-checkbox:checked').length;
                compareBtn.disabled = checkedCount < 2;
            }

            checkboxes.forEach(cb => cb.addEventListener('change', toggleButton));
        });
    </script>
@endsection
