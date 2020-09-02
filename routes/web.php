<?php

use Illuminate\Support\Facades\Route;

Route::post('/register-user', 'QrCodeAPI\RegisterUserController@create')->middleware(['api', 'ipMiddleware']);
Route::post('/generate-qrcode', 'QrCodeAPI\QrCodeGeneratorController@generate')->middleware('api');