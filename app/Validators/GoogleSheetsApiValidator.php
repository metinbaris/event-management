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
            'googleSheetsId' => 'required',
            'googleSheetsName' => 'required',
            'fullName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'university' => 'required'
        ]);

        return $validatedArray;
    }
}
