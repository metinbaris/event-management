<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\Http\Controllers\Controller;
use App\Services\UserEventService;
use App\Validators\EventRegistrationValidator;

class BaseApiController extends Controller
{
    protected $eventRegistrationValidator;
    protected $userService;
    protected $userEventService;

    /**
     * BaseApiController constructor.
     * @param EventRegistrationValidator $eventRegistrationValidator
     * @param UserEventService $userEventService
     */
    public function __construct(EventRegistrationValidator $eventRegistrationValidator, UserEventService $userEventService)
    {
        $this->eventRegistrationValidator = $eventRegistrationValidator;
        $this->userEventService = $userEventService;
    }
}