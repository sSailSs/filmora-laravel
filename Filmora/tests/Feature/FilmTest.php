<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_peut_creer_un_film()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/films', [
            'title' => 'Inception',
            'genre' => 'Science-Fiction',
            'year' => '2010',
            'duration' => '148',
            'director' => 'Christopher Nolan',
        ]);

        $response->assertRedirect('/films');
        $this->assertDatabaseHas('films', [
            'title' => 'Inception',
            'director' => 'Christopher Nolan',
        ]);
    }

    /** @test */
    public function un_film_est_visible_dans_la_liste()
    {
        $film = Film::factory()->create([
            'title' => 'Interstellar',
        ]);

        $response = $this->get('/films');
        $response->assertStatus(200);
        $response->assertSee('Interstellar');
    }
}
