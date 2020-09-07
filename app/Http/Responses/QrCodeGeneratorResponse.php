<?php

namespace App\Http\Responses;

use App\CompanyEvent;

class QrCodeGeneratorResponse
{
    const Thanks = 'We generated your qrcode, please check your inbox';
    const SomethingWentWrong = 'Something went wrong';
    protected $companyEvent;
    protected $eventAlert;

    public function __construct(?CompanyEvent $companyEvent)
    {
        $this->companyEvent = $companyEvent;
    }

    public function setQrCodeAlertMessage(): self
    {
        if (empty($this->companyEvent)) {
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

    public function generateResponseUrl(): string
    {
        $url = env('APP_URL');
        if (! empty($this->companyEvent)) {
            $url = $this->companyEvent->url;
        }

        return $url . '?eventAlert=' . $this->eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $this->eventAlert[ 'eventAlertType' ];
    }
}