<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testRegisterNewUser()
    {
        $response = $this->register_user();
        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
    }

    public function register_user()
    {
        $response = $this->post('/register-user', [
            'email' => 'hizmetparki@gmail.com',
            'companyEvent' => 'istanbul-boat-tour',
            'token' => 'sample_token_123456'
        ]);

        return $response;
    }
}
