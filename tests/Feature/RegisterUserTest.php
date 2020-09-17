<?php

namespace Tests\Feature;

use App\User;
use App\UserEvent;
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
            'email' => 'register_new_user_test_123456123@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
        $this->removeDatabaseInsertions();
    }

    private function removeDatabaseInsertions()
    {
        $user = User::where('email', 'register_new_user_test_123456123@gmail.com')->first();
        UserEvent::where('user_id', $user->id)->first()->delete();
        $user->delete();
    }
}
