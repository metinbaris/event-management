<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            'email' => 'metin@bsign.com.tr',
            'companyEvent' => 'istanbul-boat-party',
            'token' => 'sample_token_123456'
        ]);

        $response->assertDontSeeText('fail');
        $response->assertStatus(200);
        }
}
