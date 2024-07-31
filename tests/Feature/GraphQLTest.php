<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GraphQLTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);
        $response = $this->postJson('/graphql', [
            'query' => 'mutation { login(email: "'.$user->email.'", password: "password") }'
        ]);

                    // Output the response content for debugging
    // dd($response->json());
        $response->assertJsonStructure(['data' => ['login']]);
    }

    public function testCreateTask()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->postJson('/graphql', [
            'query' => 'mutation { 
                createTask(title: "Test Task", description: "Test Description", status: "todo") { 
                    id 
                    title 
                    description 
                    status 
                } 
            }'
        ], ['Authorization' => 'Bearer ' . $token]);

        $response->assertJsonStructure(['data' => ['createTask' => ['id', 'title', 'description', 'status']]]);
    }
}
