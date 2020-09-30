<?php

namespace App\Http\Responses;

use App\UserEvent;

class QrCodeValidationResponse
{
    const Thanks = 'QrCode is Validated';
    const SomethingWentWrong = 'Something went wrong';
    protected $userEvent;
    protected $eventAlert;
    protected $userData; //email, token, event_slug

    public function __construct(?UserEvent $userEvent, array $userData)
    {
        $this->userEvent = $userEvent;
        $this->userData = $userData;
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
            return env('APP_QRCODE_VALIDATION_PAGE') . '?email=' . $this->userData['email'];
        }

        return env('APP_404');
    }
}
