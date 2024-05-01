<?php

namespace Tests\Feature;

use App\Models\User; // Updated namespace to match the actual namespace of the User model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // Added trait to refresh the database after each test

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginForm() // Renamed method to follow camelCase convention
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testUserDuplication()
    {
        // Create two users with different email addresses
        $user1 = User::factory()->create([
            'name' => 'Jan Dew',
            'email' => 'jan@ph.com'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jan Dew',
            'email' => 'jan1@ph.com'
        ]);

        // Assert that the names of the users are not equal
        $this->assertNotEquals($user1->name, $user2->name);
    }
}
