<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ReviewControllerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        // Crea un utente per simulare la richiesta di autenticazione
        $user = User::factory()->create();

        // Dati della recensione da inviare nella richiesta POST
        $data = [
            'reviewer_id' => $user->id, // Utente autenticato come revisore
            'employee_id' => 1, // ID dell'impiegato da recensire (sostituisci con un ID valido presente nel database)
            'rating' => 4, // Valutazione (sostituisci con un valore valido)
            'review' => 'Ottimo lavoro!', // Commento (sostituisci con un commento valido)
        ];

        // Effettua una richiesta POST alla rotta /api/reviews
        $response = $this->actingAs($user)->post('/api/reviews', $data);

        // Verifica che la recensione sia stata creata correttamente
        $response->assertStatus(201);
        // Puoi aggiungere ulteriori asserzioni per verificare che la risposta contenga i dati corretti della recensione appena creata
    }
}
