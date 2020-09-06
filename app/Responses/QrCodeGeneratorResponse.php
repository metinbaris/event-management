<?php

namespace App\Responses;

use App\CompanyEvent;

class QrCodeGeneratorResponse
{
    const Thanks = 'We generated your qrcode, please check your inbox';
    const SomethingWentWrong = 'Something went wrong';
    protected $companyEvent;
    protected $eventAlert;

    public function __construct(CompanyEvent $companyEvent)
    {
        $this->companyEvent = $companyEvent;
    }

    public function setQrCodeAlertMessage(?CompanyEvent $companyEvent): self
    {
        if (empty($companyEvent)) {
            $this->eventAlert = [
                'eventAlert' => urlencode(self::SomethingWentWrong),
                'eventAlertType' => 'fail'
            ];

            return $this;
        }

        $this->eventAlert = [
            'eventAlert' => urlencode(self::Thanks),
            'eventAlertType' => 'success'
        ];

        return $this;
    }

    public function generateResponseUrl(CompanyEvent $companyEvent, array $eventAlert): string
    {
        return $companyEvent->url . '?eventAlert=' . $eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $eventAlert[ 'eventAlertType' ];
    }
}