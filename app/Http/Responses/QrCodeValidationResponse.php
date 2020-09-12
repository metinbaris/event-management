<?php

namespace App\Http\Responses;

use App\UserEvent;

class QrCodeValidationResponse
{
    const Thanks = 'This QrCode is Validated';
    const SomethingWentWrong = 'Something went wrong';
    protected $userEvent;
    protected $eventAlert;

    public function __construct(?UserEvent $userEvent)
    {
        $this->userEvent = $userEvent;
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
        $url = $this->userEvent->companyEvent->url ?? env('APP_URL');

        return $url . '?eventAlert=' . $this->eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $this->eventAlert[ 'eventAlertType' ];
    }
}