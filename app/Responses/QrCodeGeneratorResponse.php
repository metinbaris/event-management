<?php

namespace App\Responses;

class QrCodeGeneratorResponse
{
    const Thanks = 'We generated your qrcode, please check your inbox';

    public function getQrCodeAlertMessage(): array
    {
        return [
            'eventAlert' => urlencode(self::Thanks),
            'eventAlertType' => 'success'
        ];
    }
}