<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('films')->truncate(); // On vide la table avant (utile pour fresh)

        Film::create([
            'title' => 'Interstellar',
            'genre' => 'science-fiction',
            'year' => 2014,
            'duration' => 169,
            'director' => 'Christopher Nolan',
            'user_id' => 1, 
        ]);

        Film::create([
            'title' => 'The Dark Knight',
            'genre' => 'action',
            'year' => 2008,
            'duration' => 152,
            'director' => 'Christopher Nolan',
            'user_id' => 1,
        ]);

        Film::create([
            'title' => 'The Matrix',
            'genre' => 'action',
            'year' => '1999',
            'duration' => '136',
            'director' => 'Lana Wachowski',
            'user_id' => 1
        ]);

        Film::create([
            'title' => 'Parasite',
            'genre' => 'thriller',
            'year' => '2019',
            'duration' => '132',
            'director' => 'Bong Joon-ho',
            'user_id' => 1
        ]);

        Film::create([
            'title' => 'Inception',
            'genre' => 'science-fiction',
            'year' => '2010',
            'duration' => '148',
            'director' => 'Christopher Nolan',
            'user_id' => 2
        ]);
    }
}
