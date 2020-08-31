<?php

namespace App\Responses;

class UserEventRegistrationResponse
{
    const RegisteredBefore = 'This email has been used for registration. Please check your email to complete your registration';
    const Thanks = 'Thanks for registration, please check your inbox and approve your email now';

    public function getEventAlertMessage($userEvent): array
    {
        if (empty($userEvent)) {
            return [
                'eventAlert' => urlencode(self::RegisteredBefore),
                'eventAlertType' => 'fail'
            ];
        }

        return [
            'eventAlert' => urlencode(self::Thanks),
            'eventAlertType' => 'success'
        ];
    }
}