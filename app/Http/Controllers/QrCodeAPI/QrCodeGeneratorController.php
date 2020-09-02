<?php

namespace App\Http\Controllers\QrCodeAPI;

use App\CompanyEvent;
use App\Jobs\GenerateQrCode;
use App\User;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends QrcodeBaseApiController
{
    public function generate(Request $request): string
    {
        $email = $request->get('email');
        User::whereEmail($email)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        $companyEventId = $request->get('companyEvent');
        $companyEvent = CompanyEvent::find($companyEventId);
        GenerateQrCode::dispatch($email, $companyEvent);

        return "https://itravel.ist/thanks-for-register?companyEvent=$companyEvent->name";
    }
}
