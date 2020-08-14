<?php

use Illuminate\Support\Facades\Route;

Route::post('/register-user', 'RegisterUserController@create');
Route::get('/generate', 'QrCodeGeneratorController@generate');