<?php

namespace Tests\Feature;

use App\User;
use App\UserEvent;
use Tests\TestCase;

class QrCodeValidationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testQrValidation()
    {
        $response = $this->post('/validate-qrcode', [
            'email' => 'qr_validation_test_123456000000@gmail.com',
            'companyEvent' => 'istanbul-boat-tour',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
        $this->removeDatabaseInsertions();
    }

    private function removeDatabaseInsertions()
    {
        $user = User::where('email', 'qr_validation_test_123456000000@gmail.com')->first();
        $userEvent = UserEvent::where('user_id', $user->id)->first();
        $userEvent->update(['qrcode_verified_at' => null]);
    }
}
