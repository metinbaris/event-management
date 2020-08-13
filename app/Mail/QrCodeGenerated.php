<?php

namespace App\Mail;

use App\CompanyEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QrCodeGenerated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var CompanyEvent
     */
    public $companyEvent;

    /**
     * Create a new message instance.
     * @param CompanyEvent $companyEvent
     */
    public function __construct(CompanyEvent $companyEvent)
    {
        $this->companyEvent = $companyEvent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('qr_code_generated');
    }
}
