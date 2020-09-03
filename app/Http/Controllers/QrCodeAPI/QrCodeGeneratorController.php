<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Jobs\GenerateQrCode;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends QrcodeBaseApiController
{
    public function generate(Request $request): string
    {
        if ($this->verifyRequestCredentials($request)) {
            $companyEvent = CompanyEvent::find($request->get('companyEvent'));
            GenerateQrCode::dispatch($request->get('email'), $companyEvent);

            return "https://itravel.ist/thanks-for-register?companyEvent=$companyEvent->name";
        }

        return "something went wrong page in itravelist";
    }

    private function verifyRequestCredentials(Request $request): bool
    {
        try {
            $this->eventRegistrationValidator->validateEmailAndEvent($request);
            $token = $request->get('token');
            $email = $request->get('email');
            $companyEventId = $request->get('companyEvent');
            $this->userEventService->verifyUserEmail($email);
            $this->emailTokenService->checkEmailToken($email, $token);
            $this->userEventService->verifyUserEvent($companyEventId, $email);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
