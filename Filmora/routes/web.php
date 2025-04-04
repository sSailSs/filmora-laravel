<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Film;
use App\Models\User;

Route::view('/mentions-legales', 'mentions')->name('mentions');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route personnalisée (non couverte par resource)
Route::get('/films/compare', [FilmController::class, 'compare'])->name('films.compare');

// Toutes les routes CRUD des films (index, create, store, edit, update, destroy, show)
Route::resource('films', FilmController::class);

Route::delete('/admin/users/{user}', [ProfileController::class, 'adminDestroy'])->name('admin.users.destroy');

// Authentification
Route::middleware('auth')->group(function () {
    // Route du tableau de bord
    Route::get('/dashboard', function () {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        $userFilms = $user->films()->latest()->get(); // Récupère les films de l'utilisateur

        // Si l'utilisateur est admin, récupérer tous les films et tous les utilisateurs
        if ($user->is_admin) {
            $allFilms = Film::all();  // Tous les films
            $allUsers = User::all();  // Tous les utilisateurs
            return view('dashboard', compact('allFilms', 'allUsers', 'userFilms'));
        }

        // Sinon, seulement les films de l'utilisateur connecté
        return view('dashboard', compact('userFilms'));
    })->name('dashboard');

    // Routes pour modifier le profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
