<?php

namespace App\Services;

use App\CompanyEvent;
use App\Mail\UserEventRegistered;
use App\User;
use App\UserEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserEventService
{
    public function firstOrCreateUser(string $email, string $name): User
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            ['password' => Hash::make(env('DEFAULT_PASSWORD')), 'name' => $name]
        );

        return $user;
    }

    public function createUserEvent(User $user, CompanyEvent $event, string $emailToken): ?UserEvent
    {
        try {
            $userEvent = UserEvent::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'email_token' => $emailToken
            ]);
            Mail::to($user)->send(new UserEventRegistered($event, $user, $emailToken));

            return $userEvent;
        } catch (\Exception $e) {
            return null;
        }
    }
}