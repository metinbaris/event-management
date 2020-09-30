<?php

namespace App\Http\Responses;

use App\UserEvent;

class QrCodeValidationResponse
{
    const Thanks = 'QrCode is Validated';
    const SomethingWentWrong = 'Something went wrong';
    protected $userEvent;
    protected $eventAlert;

    public function __construct(?UserEvent $userEvent)
    {
        $this->userEvent = $userEvent;
    }

    public function setQrCodeAlertMessage(): self
    {
        if (empty($this->userEvent)) {
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
        if ($this->eventAlert[ 'eventAlertType' ] === 'success') {
            return env('APP_QRCODE_VALIDATION_PAGE');
        }

        return env('APP_404');
    }
}