<?php

namespace Tests\Feature\Http;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test if the home page returns a 200 status code.
     *
     * @return void
     */
    public function testHomePage()
    {
        // Send a GET request to the home page
        $response = $this->get('/');

        // Assert that the response status code is 200
        $response->assertStatus(200);
    }
}
