<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'ipMiddleware'])->group(function () {
    Route::post('/register-user', 'QrCodeAPI\UserRegisterController@create');
    Route::post('/generate-qrcode', 'QrCodeAPI\QrCodeGeneratorController@generate');
    Route::post('/validate-qrcode', 'QrCodeAPI\QrCodeValidationController@validateQrCode');
    Route::post('/register-user-to-event', 'GoogleSheetsApi\GoogleSheetsApiController@store');
});
