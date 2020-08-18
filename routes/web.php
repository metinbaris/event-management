<?php

use Illuminate\Support\Facades\Route;

Route::post('/register-user', 'QrCodeAPI\RegisterUserController@create');
Route::get('/generate', 'QrCodeAPI\QrCodeGeneratorController@generate');