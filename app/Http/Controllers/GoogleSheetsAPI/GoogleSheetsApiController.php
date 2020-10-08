<?php

namespace App\Http\Controllers\GoogleSheetsAPI;

use App\Services\GoogleSheetsService;
use App\Validators\GoogleSheetsApiValidator;
use Illuminate\Http\Request;

class GoogleSheetsApiController
{
    /**
     * @var GoogleSheetsService
     */
    protected $googleSheetsService;
    /**
     * @var GoogleSheetsApiValidator
     */
    protected $googleSheetsApiValidator;

    /**
     * GoogleSheetsApiController constructor.
     * @param GoogleSheetsService $googleSheetsService
     * @param GoogleSheetsApiValidator $googleSheetsApiValidator
     */
    public function __construct(
        GoogleSheetsService $googleSheetsService,
        GoogleSheetsApiValidator $googleSheetsApiValidator
    ) {
        $this->googleSheetsService = $googleSheetsService;
        $this->googleSheetsApiValidator = $googleSheetsApiValidator;
    }

    public function store(Request $request)
    {
        $data = $this->googleSheetsApiValidator->validateEventRegistrationForm($request);

        try {
            $this->googleSheetsService->insert($data);

            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
