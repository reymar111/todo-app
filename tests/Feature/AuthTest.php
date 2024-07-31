<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['token']);
    }

    public function testLogin()
    {
        $user = \App\Models\User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        
        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function testLogout()
    {
        $user = \App\Models\User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Logged out successfully']);
    }
}
