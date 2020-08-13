<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class QrCodeGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'event' => 'required|exist:company_events, id',
        ]);

        Artisan::call('qrcode:generate 1 --queue=default');

        return response()->json([
            $validatedData
        ]);
    }
}
