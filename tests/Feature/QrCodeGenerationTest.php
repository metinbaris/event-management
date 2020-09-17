<?php

namespace Tests\Feature;

use App\User;
use App\UserEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class QrCodeGenerationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testQrGeneration()
    {
        $response = $this->post('/generate-qrcode', [
            'email' => 'qr_generation_test_123456000000@gmail.com',
            'companyEvent' => 'istanbul-boat-party',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
        $this->removeDatabaseInserts();
    }

    private function removeDatabaseInserts()
    {
        $user = User::where('email', 'qr_generation_test_123456000000@gmail.com')->first();
        $userEvent = UserEvent::where('user_id', $user->id)->first();
        $userEvent->update(['email_verified_at' => null]);
    }
}
