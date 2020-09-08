<?php

namespace App\Services;

use App\UserEvent;
use App\User;

class EmailTokenService
{
    public function checkEmailToken(User $user, string $token): UserEvent
    {
        $userEvent = UserEvent::where('user_id', $user->id)->where('token', $token)->firstOrFail();

        return $userEvent;
    }
}