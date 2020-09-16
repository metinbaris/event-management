<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Http\Responses\RegisterUserResponse;
use App\Traits\NameFromEmail;
use Illuminate\Http\Request;

class RegisterUserController extends QrCodeBaseApiController
{
    use NameFromEmail;

    public function create(Request $request): string
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        $name = $this->getNameFromEmail($email);
        $companyEventSlug = $request->get('companyEvent');
        $user = $this->userEventService->firstOrCreateUser($email, $name);
        $companyEvent = CompanyEvent::where('slug', $companyEventSlug)->first();
        $token = $request->get('token');
        $userEvent = $this->userEventService->createUserEvent($user, $companyEvent, $token);
        $response = new RegisterUserResponse($companyEvent);
        $responseUrl = $response->setEventAlertMessage($userEvent)->generateResponseUrl();

        return $responseUrl;
    }
}
