<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testRegisterNewUser()
    {
        $response = $this->post('/register-user', [
            'email' => 'mizbocom@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
    }
}
