<?php

namespace App\Http\Controllers\QrCodeAPI;

use Illuminate\Http\Request;

class QrCodeValidationController extends QrCodeBaseApiController
{
    public function validateQrCode(Request $request)
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
    }
}

