<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\Http\Responses\RegisterUserResponse;
use App\Services\UserRegisterService;
use Illuminate\Http\Request;

class RegisterUserController extends QrCodeBaseApiController
{
    public function create(Request $request, UserRegisterService $userRegisterService): string
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $userRegisterService = $userRegisterService->setUserRegistrationData(
            $request->get('email'),
            $request->get('token'),
            $request->get('companyEvent')
        )->registerUserToEvent();

        $response = new RegisterUserResponse($userRegisterService);

        $responseUrl = $response->setEventAlertMessage()->generateResponseUrl();

        return $responseUrl;
    }
}
