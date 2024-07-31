<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GraphQLTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTask()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->postJson('/graphql', [
            'query' => 'mutation { 
                createTask(description: "Test Description", done: false, user_id: 1) { 
                    id 
                    description 
                    done 
                    user_id
                } 
            }'
        ], ['Authorization' => 'Bearer ' . $token]);

        $response->assertJsonStructure(['data' => ['createTask' => ['id', 'description', 'done', 'user_id']]]);
    }
}
