<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testRegisterNewUser()
    {
        $response = $this->post('/register-user', [
            'email' => 'mizbocom@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
    }
}
