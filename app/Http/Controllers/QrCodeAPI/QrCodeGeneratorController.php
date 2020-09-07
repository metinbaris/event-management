<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Jobs\GenerateQrCode;
use App\Http\Responses\QrCodeGeneratorResponse;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends QrCodeBaseApiController
{
    public function generate(Request $request): string
    {
        $companyEvent = [];
        if ($this->verifyRequestCredentials($request)) {
            $companyEvent = CompanyEvent::find($request->get('companyEvent'));
            GenerateQrCode::dispatch($request->get('email'), $companyEvent);
        }
        $response = new QrCodeGeneratorResponse($companyEvent);
        $responseUrl = $response->setQrCodeAlertMessage()->generateResponseUrl();

        return $responseUrl;
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
            $this->report($e);

            return false;
        }
    }
}
