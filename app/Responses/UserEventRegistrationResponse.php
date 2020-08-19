<?php

namespace App\Responses;

class UserEventRegistrationResponse
{
    public function getEventAlertMessage($userEvent): array
    {
        if (empty($userEvent)) {
            return [
                'eventAlert' => urlencode('This email has been used for registration'),
                'eventAlertType' => 'fail'
            ];
        }

        return [
            'eventAlert' => urlencode('Thank you for registering we send your qrcode'),
            'eventAlertType' => 'success'
        ];
    }
}