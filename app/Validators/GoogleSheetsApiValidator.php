<?php

namespace App\Validators;

use Illuminate\Http\Request;

class GoogleSheetsApiValidator
{
    /** Validates coming request from main page
     * @param Request $request
     * @return array
     */
    public function validateEventRegistrationForm(Request $request): array
    {
        $validatedArray = $request->validate([
            'googleSheetId' => 'required|string',
            'googleSheetName' => 'required',
            'fullName' => 'required|',
            'gender' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
            'university' => 'required',
        ]);

        return $validatedArray;
    }
}
