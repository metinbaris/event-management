<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::post('/register-user', 'QrCodeAPI\RegisterUserController@create');
    Route::post('/generate-qrcode', 'QrCodeAPI\QrCodeGeneratorController@generate');
});