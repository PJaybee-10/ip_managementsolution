<?php

namespace Tests\Feature;

use App\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   
    function test_login_form() {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    function test_user_duplication() {
        $user1 = User::make([
            'name' => 'Jan Dew',
            'email' => 'jan@ph.com'
        ]);

        $user2 = User::make([
            'name' => 'Jan Dew',
            'email' => 'jan1@ph.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }
}
