<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterAlreadyRegisteredUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testAlreadyRegisteredUser()
    {
        $response = $this->post('/register-user', [
            'email' => 'alreadyregistereduser_test111@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('success');
        $response->assertStatus(200);
    }
}
