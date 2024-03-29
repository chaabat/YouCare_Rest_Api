<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class authTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister(): void
    {
        $register = $this->post('/api/register',[
            'name' => 'Test User',
            'email' => 'test@ch.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'organisateur',
        ]);
        $register->assertStatus(200);
    }


//     public function testLogin(): void
// {
//     $user = User::factory()->create([
//         'email' => 'test@test.com',
//         'password' => Hash::make('password'),
//     ]);

//     $login = $this->post('api/login', [
//         'email' => 'test@test.com',
//         'password' => 'password',
//     ]);

//     $login->assertStatus(200);
// }
}
