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
        $register = $this->post('/api/register',[
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'organisateur',
        ]);
        $register->assertStatus(200);
    }


    public function testLogin(): void
{
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $login = $this->post('api/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $login->assertStatus(200);
}

}
