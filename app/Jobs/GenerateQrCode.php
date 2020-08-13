<?php

namespace App\Jobs;

use App\CompanyEvent;
use App\Mail\QrCodeGenerated;
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
     * Create a new job instance.
     * @param string $email
     * @param CompanyEvent $companyEvent
     */
    public function __construct(string $email, CompanyEvent $companyEvent)
    {
        $this->email = $email;
        $this->companyEvent = $companyEvent;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new QrCodeGenerated($this->companyEvent));
    }
}
