<?php

namespace App\Http\Responses;

use App\Services\UserRegisterService;

class RegisterUserResponse
{
    const RegisteredBefore = 'This email has been used for registration. Please check your email to complete your registration';
    const Thanks = 'Thanks for registration, please check your inbox and approve your email now';

    /**
     * @var UserRegisterService
     */
    protected $userRegisterService;

    /**
     * @var array
     */
    protected $eventAlert = [];

    /**
     * RegisterUserResponse constructor.
     * @param UserRegisterService $userRegisterService
     */
    public function __construct(UserRegisterService $userRegisterService)
    {
        $this->userRegisterService = $userRegisterService;
    }

    public function setEventAlertMessage(): self
    {
        if (empty($this->userRegisterService->getUserEvent())) {
            $this->eventAlert = [
                'eventAlert' => urlencode(self::RegisteredBefore),
                'eventAlertType' => 'fail'
            ];

            return $this;
        }

        $this->eventAlert = [
            'eventAlert' => urlencode(self::Thanks),
            'eventAlertType' => 'success'
        ];

        return $this;
    }

    public function generateResponseUrl(): string
    {
        return $this->userRegisterService->getCompanyEvent()->url . '?eventAlert=' . $this->eventAlert[ 'eventAlert' ]
            . '&eventAlertType=' . $this->eventAlert[ 'eventAlertType' ];
    }
}
