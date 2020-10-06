<?php

namespace App\Http\Controllers\GoogleSheetsAPI;

class GoogleSheetsApiController extends GoogleSheetsBaseApiController
{
    public function getValues()
    {
        $service = $this->getGoogleSheetService();
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
