<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\Http\Controllers\Controller;
use App\Responses\UserEventRegistrationResponse;
use App\Services\UserEventService;
use App\Validators\EventRegistrationValidator;

class QrcodeBaseApiController extends Controller
{
    protected $eventRegistrationValidator;
    protected $userEventService;
    protected $userEventRegistrationResponse;

    /**
     * BaseApiController constructor.
     * @param EventRegistrationValidator $eventRegistrationValidator
     * @param UserEventService $userEventService
     * @param UserEventRegistrationResponse $userEventRegistrationResponse
     */
    public function __construct(
        EventRegistrationValidator $eventRegistrationValidator,
        UserEventService $userEventService,
        UserEventRegistrationResponse $userEventRegistrationResponse
    ) {
        $this->eventRegistrationValidator = $eventRegistrationValidator;
        $this->userEventService = $userEventService;
        $this->userEventRegistrationResponse = $userEventRegistrationResponse;
    }
}