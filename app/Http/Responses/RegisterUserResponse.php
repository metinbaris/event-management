<?php

namespace App\Http\Responses;

use App\CompanyEvent;

class RegisterUserResponse
{
    const RegisteredBefore = 'This email has been used for registration. Please check your email to complete your registration';
    const Thanks = 'Thanks for registration, please check your inbox and approve your email now';

    protected $companyEvent;
    protected $eventAlert;

    public function __construct(CompanyEvent $companyEvent)
    {
        $this->companyEvent = $companyEvent;
    }

    public function setEventAlertMessage($userEvent): self
    {
        if (empty($userEvent)) {
            $this->eventAlert = [
                'eventAlert' => urlencode(self::RegisteredBefore),
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
        return $this->companyEvent->url . '?eventAlert=' . $this->eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $this->eventAlert[ 'eventAlertType' ];
    }
}