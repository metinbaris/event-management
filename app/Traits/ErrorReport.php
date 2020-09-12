<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait ErrorReport
{
    public function reportAsMail(\Exception $exception)
    {
        $data = $exception->getMessage();
        Mail::raw("There was an error : $data", function ($message) {
            $message->to('metin@bsign.com.tr')->subject('Error Report');
        });
    }
}