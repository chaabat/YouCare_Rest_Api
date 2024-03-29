<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Annonce;

class annonceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testAnnoceCreated()
    {

        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/create', [
            'user_id' => $user->id,
            'titre' => 'titre',
            'description' => 'description',
            'date' => '2000-2-21',
            'localisation' => 'location',
            'competence' => 'comend',
            'type_id' => 2,
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateAnnonce()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $announcement = Annonce::create([
            'user_id' => $user->id,
            'titre' => 'Updated Title',
            'description' => 'Updated Description',
            'date' => '2024-03-27',
            'localisation' => 'Updated localisation',
            'competence' => 'Updated Competence',
            'type_id' => 2,
        ]);
        $response = $this->put('/api/update/' . $announcement->id, [
            'user_id' => $user->id,
            'titre' => 'Updated Titlehhhhhhhhhh',
            'description' => 'Updated Descriptionhhhhhhh',
            'date' => '2024-03-11',
            'localisation' => 'Updated localisationhhhhhh',
            'competence' => 'Updated Competencehhhhhh',
            'type_id' => 2,
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteAnnonce()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $announcement = Annonce::create([
            'user_id' => $user->id,
            'titre' => 'Updated Titlehhhhhhhhhh',
            'description' => 'Updated Descriptionhhhhhhh',
            'date' => '2024-03-11',
            'localisation' => 'Updated localisationhhhhhh',
            'competence' => 'Updated Competencehhhhhh',
            'type_id' => 2,
        ]);
        $response = $this->delete('/api/delete/' . $announcement->id, []);
        $response->assertStatus(200);
    }
}
