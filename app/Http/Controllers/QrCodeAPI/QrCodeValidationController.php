<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Http\Responses\QrCodeValidationResponse;
use App\User;
use App\UserEvent;
use Illuminate\Http\Request;

class QrCodeValidationController extends QrCodeBaseApiController
{
    public function validateQrCode(Request $request): string
    {
        $userData = $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $userEvent = null;
        try {
            $userEvent = $this->verifiedRequestCredentials($request);
            $userEvent->update(['qrcode_verified_at' => date('Y-m-d H:i:s')]);
        } catch (\Exception $e) {
            $this->reportAsMail($e);
        }
        $response = new QrCodeValidationResponse($userEvent, $userData);
        $responseUrl = $response->setQrCodeAlertMessage()->generateResponseUrl();

        return $responseUrl;
    }

    private function verifiedRequestCredentials(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        $event = CompanyEvent::where('slug', $request->get('companyEvent'))->first();

        return UserEvent::where('token', $request->get('token'))
            ->where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->whereNotNull('email_verified_at')
            ->with('user')
            ->with('companyEvent')
            ->firstOrFail();
    }
}
