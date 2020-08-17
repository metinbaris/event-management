<?php

namespace App\Http\Controllers;

use App\CompanyEvent;
use App\Http\Controllers\QrCodeAPI\BaseApiController;
use Illuminate\Http\Request;
use App\Traits\NameFromEmail;

class RegisterUserController extends BaseApiController
{
    use nameFromEmail;

    public function create(Request $request)
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        $name = $this->getNameFromEmail($email);
        $companyEventId = $request->get('companyEvent');
        $user = $this->userEventService->firstOrCreateUser($email, $name);
        $companyEvent = CompanyEvent::find($companyEventId);
        $userEvent = $this->userEventService->createUserEvent($user, $companyEvent);
        $eventAlert = $this->getEventAlertMessage($userEvent);

        return redirect("$companyEvent->url?eventAlert=$eventAlert[0]&eventAlertType=$eventAlert[1]");
    }

    private function getEventAlertMessage($userEvent): array
    {
        if (empty($userEvent)) {
            return [urlencode('This email has been used for registration'), 'fail'];
        }

        return [urlencode('Thank you for registering we send your qrcode'), 'success'];
    }
}
