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
        $emailToken = $request->get('token');
        $userEvent = $this->userEventService->createUserEvent($user, $companyEvent, $emailToken);
        $eventAlert = $this->userEventRegistrationResponse->getEventAlertMessage($userEvent);
        $responseUrl = $this->generateResponseUrl($companyEvent, $eventAlert);

        return $responseUrl;
    }

    private function generateResponseUrl(CompanyEvent $companyEvent, array $eventAlert): string
    {
        return $companyEvent->url . '?eventAlert=' . $eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $eventAlert[ 'eventAlertType' ];
    }
}
