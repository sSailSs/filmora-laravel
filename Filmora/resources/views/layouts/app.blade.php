<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Filmora')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen overflow-x-hidden bg-cover bg-center" style="background-image: url('/images/space-background.jpg')">

    <!-- Navigation -->
    @if (!request()->routeIs('welcome'))
        <nav class="navbar">
            <a href="{{ route('home') }}" class="logo">🎬 Filmora</a>
            <div class="nav-group">
                <div class="nav-links">
                    <a href="{{ route('films.index') }}">Liste des films</a>
                    <a href="{{ route('films.create') }}">Ajouter un film</a>
                    @auth
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}">Se connecter</a>
                        <a href="{{ route('register') }}">S'inscrire</a>
                    @endguest
                </div>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="btn-logout">Se déconnecter</button>
                    </form>
                @endauth
            </div>
        </nav>
    @endif

    <!-- Contenu -->
    <main class="container flex-grow mt-24">
        @yield('content')
    </main>

    <!-- Footer collé en bas -->
    <footer class="footer">
        <div class="footer-content">
            © {{ date('Y') }} Filmora — Site fictif.
            <span class="ml-2">
                <a href="{{ route('mentions') }}" class="mentions-link">Mentions légales</a>
            </span>
        </div>
    </footer>



</body>
</html>
