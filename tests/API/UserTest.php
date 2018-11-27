<?php

namespace Tests\API;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('passport:install', [
            '--force' => true,
        ]);
    }

    /**  @test */
    public function it_registers_a_user_and_get_a_token()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Sally Hobs',
            'email' => 'name@example.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['success']);
    }
}