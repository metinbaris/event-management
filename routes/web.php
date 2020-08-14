<?php

use Illuminate\Support\Facades\Route;

Route::post('/register-user', 'RegisterUserController@create');
Route::post('/generate', 'QrCodeGeneratorController@generate');