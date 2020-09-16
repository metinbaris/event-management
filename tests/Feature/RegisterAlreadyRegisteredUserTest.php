<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterAlreadyRegisteredUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testAlreadyRegisteredUser()
    {
        $response = $this->post('/register-user', [
            'email' => 'hizmetparki@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
        ]);

        $response->assertDontSeeText('success');
        $response->assertStatus(200);
    }
}
