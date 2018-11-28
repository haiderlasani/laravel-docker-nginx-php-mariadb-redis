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
        $response = $this->postJson('/api/user/register', [
            'name' => 'Sally Hobs',
            'email' => 'name@example.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token', 'user']);
    }

    /**  @test */
    public function it_login_and_get_a_user_detail_with_token()
    {
        $this->postJson('/api/user/register', [
            'name' => 'Sally Hobs',
            'email' => 'name@example.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => 'name@example.com',
            'password' => 'secret',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token', 'user']);
    }

    /**  @test */
    public function it_login_under_wrong_credentials_and_get_401()
    {
        $response = $this->postJson('/api/user/login', [
            'email' => 'name@example.com',
            'password' => 'blabla',
        ]);

        $response
            ->assertStatus(401)
            ->assertJsonStructure(['error']);
    }
}