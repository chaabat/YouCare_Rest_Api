<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function testAnnoceCreated(){

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

    // public function testupdateCreated()
    // {
    //     $user = User::factory()->create();
    //     $annonce = Annonce::factory()->create(['user_id' => $user->id]);
    //     $this->actingAs($user);
    //     $response = $this->put('/api/update/' . $annonce->id, [ // Added slash (/) before the ID
    //         'titre' => 'titre',
    //         'description' => 'description',
    //         'date' => '2000-2-21',
    //         'localisation' => 'location',
    //         'competence' => 'comend',
    //         'type_id' => 2,
    //     ]);
    //     $response->assertStatus(200);
    // }
}
