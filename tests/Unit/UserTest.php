<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
    	$response = $this->json('POST', '/users', ['name' => 'Sally']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }
}
