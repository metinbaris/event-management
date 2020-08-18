<?php

namespace App\Responses;

class UserEventRegistrationResponse
{
    public function getEventAlertMessage($userEvent): array
    {
        if (empty($userEvent)) {
            return [urlencode('This email has been used for registration'), 'fail'];
        }

        return [urlencode('Thank you for registering we send your qrcode'), 'success'];
    }
}