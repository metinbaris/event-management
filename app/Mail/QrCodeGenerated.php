<?php

namespace App\Mail;

use App\CompanyEvent;
use Endroid\QrCode\QrCode;
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
     * @var QrCode
     */
    public $qrCode;

    /**
     * Create a new message instance.
     * @param CompanyEvent $companyEvent
     * @param QrCode $qrCode
     */
    public function __construct(CompanyEvent $companyEvent, QrCode $qrCode)
    {
        $this->companyEvent = $companyEvent;
        $this->qrCode = $qrCode;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->subject('Event Registration Completed')->view('emails.qrcode_generated');
    }
}
