<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use Illuminate\Http\Request;
use App\Traits\NameFromEmail;

class RegisterUserController extends QrcodeBaseApiController
{
    use NameFromEmail;

    public function create(Request $request)
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        $name = $this->getNameFromEmail($email);
        $companyEventId = $request->get('companyEvent');
        $user = $this->userEventService->firstOrCreateUser($email, $name);
        $companyEvent = CompanyEvent::find($companyEventId);
        $userEvent = $this->userEventService->createUserEvent($user, $companyEvent);
        $eventAlert = $this->userEventRegistrationResponse->getEventAlertMessage($userEvent);

        return redirect("$companyEvent->url?eventAlert=$eventAlert[0]&eventAlertType=$eventAlert[1]");
    }
}
