<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Http\Responses\QrCodeGeneratorResponse;
use App\Jobs\GenerateQrCode;
use App\User;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends QrCodeBaseApiController
{
    public function generate(Request $request): string
    {
        $companyEvent = null;
        if ($this->verifyRequestCredentials($request)) {
            $companyEvent = CompanyEvent::find($request->get('companyEvent'));
            GenerateQrCode::dispatch($request->get('email'), $companyEvent, $request->get('token'));
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
            $user = User::whereEmail($email)->firstOrFail();
            $this->userEventService->verifyUserEmail($user);
            $this->emailTokenService->checkEmailToken($user, $token);
            $this->userEventService->verifyUserEvent($user->id, $companyEventId);

            return true;
        } catch (\Exception $e) {
            $this->reportAsMail($e);

            return false;
        }
    }
}
