<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use Illuminate\Http\Request;
use App\Traits\NameFromEmail;

class RegisterUserController extends QrcodeBaseApiController
{
    use NameFromEmail;

    public function create(Request $request): string
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        $name = $this->getNameFromEmail($email);
        $companyEventId = $request->get('companyEvent');
        $user = $this->userEventService->firstOrCreateUser($email, $name);
        $companyEvent = CompanyEvent::find($companyEventId);
        $token = $request->get('token');
        $userEvent = $this->userEventService->createUserEvent($user, $companyEvent, $token);
        $eventAlert = $this->userEventRegistrationResponse->getEventAlertMessage($userEvent);
        $responseUrl = $this->generateResponseUrl($companyEvent, $eventAlert, $token);

        return $responseUrl;
    }

    private function generateResponseUrl(CompanyEvent $companyEvent, array $eventAlert, string $token): string
    {
        return $companyEvent->url . '?eventAlert=' . $eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $eventAlert[ 'eventAlertType' ] . '&token=' . $token;
    }
}
