<?php

namespace App\Validators;

use Illuminate\Http\Request;

class EventRegistrationValidator
{
    public function validateEmailAndEvent(Request $request): array
    {
        $validatedArray = $request->validate([
            'email' => 'required|email',
            'companyEvent' => 'exists:company_events,id|required',
            'token' => 'required|string'
        ]);

        return $validatedArray;
    }
}