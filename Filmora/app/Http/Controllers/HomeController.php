<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class HomeController extends Controller
{  
    public function index()
    {
        // Récupère les 5 dernières planètes ajoutées
        $lastFilms = Film::latest()->take(5)->get();

        return view('home', compact('lastFilms'));
}
}