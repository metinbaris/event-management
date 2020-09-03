<?php

namespace App\Services;

use App\UserEvent;
use App\User;

class EmailTokenService
{
    public function checkEmailToken(string $email, string $token)
    {
        $user = User::where('email', $email)->firstOrFail();
        $userEvent = UserEvent::where('user_id', $user->id)->where('token', $token)->firstOrFail();

        return $userEvent;
    }
}