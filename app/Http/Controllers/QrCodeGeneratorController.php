<?php

namespace App\Http\Controllers;

use App\CompanyEvent;
use App\Jobs\GenerateQrCode;
use App\User;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        $email = $request->get('email');
        User::whereEmail($email)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        $companyEventId = $request->get('companyEvent');
        $companyEvent = CompanyEvent::find($companyEventId);
        GenerateQrCode::dispatch($email, $companyEvent);

        return redirect("https://itravel.ist/thanks-for-register?companyEvent=$companyEvent->name");
    }
}
