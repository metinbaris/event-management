<?php

namespace App\Jobs;

use App\CompanyEvent;
use App\Mail\QrCodeGenerated;
use Endroid\QrCode\QrCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateQrCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var int
     */
    protected $event;
    /**
     * @var CompanyEvent
     */
    protected $companyEvent;
    /**
     * @var string
     */
    protected $token;

    /**
     * GenerateQrCode constructor.
     * @param string $email
     * @param CompanyEvent $companyEvent
     * @param string $token
     */
    public function __construct(string $email, CompanyEvent $companyEvent, string $token)
    {
        $this->email = $email;
        $this->companyEvent = $companyEvent;
        $this->token = $token;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $qrCode = $this->createNewQrCode($this->email, $this->companyEvent);
        Mail::to($this->email)->send(new QrCodeGenerated($this->companyEvent, $qrCode));
    }

    private function createNewQrCode(string $email, CompanyEvent $companyEvent)
    {
        $url = env('CONNECTION_URL') . '/checkqrcode?email=' . $email . '&companyEvent=' . $companyEvent->slug . '&token=' . $this->token;
        $qrCode = new QrCode($url);

        return $qrCode;
    }
}
