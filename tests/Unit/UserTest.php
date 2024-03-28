<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     */
    public function testRegister(): void
    {
        // Define request data
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 'user',
        ];

        // Make POST request to register endpoint
        $response = $this->postJson('/api/register', $userData);

        // Assert response status
        $response->assertStatus(200);

        // Assert response structure and content
        $response->assertJson([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role'],
            ],
        ]);

        // Assert token is present in the response
        $response->assertJsonStructure([
            'authorization' => [
                'token',
                'type',
            ],
        ]);

        // Assert user exists in the database
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'role' => $userData['role'],
        ]);

        // Assert password is hashed in the database
        $this->assertTrue(Hash::check($userData['password'], User::where('email', $userData['email'])->first()->password));
    }


    // public function testLogin(): void
    // {
    //     // Create a user
    //     $password = 'password';
    //     $user = User::factory()->create([
    //         'password' => Hash::make($password),
    //     ]);

    //     // Define login data
    //     $loginData = [
    //         'email' => $user->email,
    //         'password' => $password,
    //     ];

    //     // Make POST request to login endpoint
    //     $response = $this->postJson('/api/login', $loginData);

    //     // Assert response status
    //     $response->assertStatus(200);

    //     // Assert response structure and content
    //     $response->assertJson([
    //         'status' => 'success',
    //     ]);

    //     // Assert token is present in the response
    //     $response->assertJsonStructure([
    //         'authorization' => [
    //             'token',
    //             'type',
    //         ],
    //     ]);
    // }
}
