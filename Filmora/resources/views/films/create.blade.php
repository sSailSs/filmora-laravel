@extends('layouts.app')

@section('title', 'Ajouter un Film')

@section('content')
    <h2>🎬 Ajouter un Film</h2>
    <form action="{{ route('films.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Titre :</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Genre :</label>
            <input type="text" name="genre" class="form-control" required>
            @error('genre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Année de sortie :</label>
            <input type="text" name="year" class="form-control" required>
            @error('year')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Durée (minutes) :</label>
            <input type="number" name="duration" class="form-control" required>
            @error('duration')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Réalisateur :</label>
            <input type="text" name="director" class="form-control" required>
            @error('director')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
@endsection
