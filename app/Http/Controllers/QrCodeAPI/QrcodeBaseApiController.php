<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\Http\Controllers\Controller;
use App\Responses\UserEventRegistrationResponse;
use App\Services\EmailTokenService;
use App\Services\UserEventService;
use App\Traits\ErrorReport;
use App\Validators\EventRegistrationValidator;

class QrcodeBaseApiController extends Controller
{
    use ErrorReport;

    protected $eventRegistrationValidator;
    protected $userEventService;
    protected $userEventRegistrationResponse;
    protected $emailTokenService;

    /**
     * BaseApiController constructor.
     * @param EventRegistrationValidator $eventRegistrationValidator
     * @param UserEventService $userEventService
     * @param UserEventRegistrationResponse $userEventRegistrationResponse
     * @param EmailTokenService $emailTokenService
     */
    public function __construct(
        EventRegistrationValidator $eventRegistrationValidator,
        UserEventService $userEventService,
        UserEventRegistrationResponse $userEventRegistrationResponse,
        EmailTokenService $emailTokenService
    ) {
        $this->eventRegistrationValidator = $eventRegistrationValidator;
        $this->userEventService = $userEventService;
        $this->userEventRegistrationResponse = $userEventRegistrationResponse;
        $this->emailTokenService = $emailTokenService;
    }
}