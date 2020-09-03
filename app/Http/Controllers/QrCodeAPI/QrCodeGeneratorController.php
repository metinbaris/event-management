<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Jobs\GenerateQrCode;
use App\User;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends QrcodeBaseApiController
{
    public function generate(Request $request): string
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $token = $request->get('token');
        $email = $request->get('email');
        $this->userEventService->verifyUserEmail($email);
        $this->emailTokenService->checkEmailToken($email, $token);
        $companyEventId = $request->get('companyEvent');
        $this->userEventService->verifyUserEvent($companyEventId, $email);
        $companyEvent = CompanyEvent::find($companyEventId);
        GenerateQrCode::dispatch($email, $companyEvent);

        return "https://itravel.ist/thanks-for-register?companyEvent=$companyEvent->name";
    }
}
