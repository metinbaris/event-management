<?php

namespace App\Http\Controllers\GoogleSheetsAPI;

use App\Services\GoogleSheetsService;

class GoogleSheetsApiController
{
    /**
     * @var GoogleSheetsService
     */
    protected $googleSheetsService;

    /**
     * GoogleSheetsApiController constructor.
     * @param GoogleSheetsService $googleSheetsService
     */
    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    /**
     * 
     */
    public function getValues()
    {
        $service = $this->googleSheetsService->getService();
        $spreadsheetId = env('GOOGLE_SPREAD_SHEET_ID_FOR_REGISTER');
        $range = 'A1:E1';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);

        $values = $response->getValues();
        if (empty($values)) {
            print "No data found.\n";
        } else {
            print "Name, Major:\n";
            foreach ($values as $row) {
                // Print columns A and E, which correspond to indices 0 and 4.
                printf("%s, %s\n", $row[ 0 ], $row[ 4 ]);
            }
        }
    }
}
