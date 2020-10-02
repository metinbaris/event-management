<?php

namespace Tests\Feature;

use App\CompanyEvent;
use App\User;
use App\UserEvent;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QrCodeGeneratorTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, WithFaker;

    /**
     * @var string
     */
    protected $user_email_address = 'hizmetparki@gmail.com';
    /**
     * @var string
     */
    protected $company_event_slug = 'istanbul-boat-party';
    /**
     * @var string
     */
    protected $sample_token = 'sample_token';

    public function testQrGeneration()
    {
        $this->create_required_database_credentials();
        $response = $this->post('/generate-qrcode', [
            'email' => $this->user_email_address,
            'companyEvent' => $this->company_event_slug,
            'token' => $this->sample_token
        ]);
        $response->assertDontSeeText('fail');
        $response->assertSeeText('success');
        $response->assertStatus(200);
    }

    /**
     *
     */
    private function create_required_database_credentials()
    {
        $company_event = CompanyEvent::create([
            'name' => $this->faker->streetName,
            'slug' => $this->company_event_slug,
            'url' => $this->faker->url,
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
        ]);

        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->user_email_address,
            'email_verified_at' => $this->faker->dateTime,
            'password' => $this->faker->password
        ]);

        UserEvent::create([
            'user_id' => $user->id,
            'event_id' => $company_event->id,
            'token' => $this->sample_token,
            'email_verified_at' => null,
            'qrcode_verified_at' => null
        ]);
    }
}
