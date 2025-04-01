@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <h2>🎬 Tableau de bord</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-content">
        <p>Bienvenue, {{ auth()->user()->name }} !</p>

        <!-- Boutons profil & support utilisateur -->
        <div class="flex justify-center my-4 gap-4">
        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
            Modifier le profil
        </a>

        @if(!auth()->user()->is_admin)
            <a href="http://90.121.52.205:50302/" 
            target="_blank" 
            title="Cela vous redirigera vers l'interface de support (GLPI)"
            class="btn btn-warning">
                Un problème ?
            </a>
        @endif
    </div>


        <!-- Si l'utilisateur est un administrateur, afficher la vue d'ensemble -->
        @if(auth()->user()->is_admin)
            <h3 class="text-xl font-semibold mt-6 mb-4 text-blue-400">🎞️ Vue d'ensemble des films et utilisateurs</h3>

            <!-- Vue des films -->
            <h4 class="text-lg font-semibold mb-4">Films du site</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Genre</th>
                        <th>Réalisateur</th>
                        <th>Année</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allFilms as $film)
                        <tr>
                            <td class="font-bold text-white">{{ strtoupper($film->title) }}</td>
                            <td>{{ $film->genre }}</td>
                            <td>{{ $film->director }}</td>
                            <td>{{ $film->year }}</td>
                            <td class="text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                    <a href="{{ route('films.edit', $film->id) }}"
                                       class="inline-block bg-blue-600 text-white no-underline px-4 py-2 rounded font-semibold hover:bg-blue-700 transition">
                                        ✏️ Modifier
                                    </a>

                                    <form action="{{ route('films.destroy', $film->id) }}" method="POST" onsubmit="return confirm('Supprimer ce film ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded font-semibold hover:bg-red-700 transition">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Vue des utilisateurs -->
            <h4 class="text-lg font-semibold mb-4 mt-6">Utilisateurs du site</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Administrateur' : 'Utilisateur' }}</td>
                            <td class="text-center">
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded font-semibold hover:bg-red-700 transition">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 italic">Impossible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h3 class="text-xl font-semibold mt-6 mb-4 text-blue-400">🎬 Vos films ajoutés</h3>

        @if($userFilms->isEmpty())
            <p class="text-gray-400">Vous n'avez encore ajouté aucun film.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Genre</th>
                        <th>Réalisateur</th>
                        <th>Année</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userFilms as $film)
                        <tr>
                            <td class="font-bold text-white">{{ strtoupper($film->title) }}</td>
                            <td>{{ $film->genre }}</td>
                            <td>{{ $film->director }}</td>
                            <td>{{ $film->year }}</td>
                            <td class="text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                    <a href="{{ route('films.edit', $film->id) }}"
                                       class="inline-block bg-blue-600 text-white no-underline px-4 py-2 rounded font-semibold hover:bg-blue-700 transition">
                                        ✏️ Modifier
                                    </a>

                                    <form action="{{ route('films.destroy', $film->id) }}" method="POST" onsubmit="return confirm('Supprimer ce film ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded font-semibold hover:bg-red-700 transition">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
