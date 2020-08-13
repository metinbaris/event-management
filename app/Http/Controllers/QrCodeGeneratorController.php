<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateQrCodeJob;
use Illuminate\Http\Request;

class QrCodeGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        //$validatedData = $request->validate([
        //    'email' => 'required|email',
        //    'event' => 'required|exist:company_events, id',
        //]);
        $email = $request->get('email');
        $qrCode = new GenerateQrCodeJob($email);

        return response()->json([

        ]);
    }
}
