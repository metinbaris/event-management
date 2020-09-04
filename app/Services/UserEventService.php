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

    public function verifyUserEmail($email)
    {
        return User::where('email', $email)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
    }

    public function verifyUserEvent(int $companyEventId, string $email): UserEvent
    {
        $userEvent = User::whereEmail($email)->with([
            'events' => function ($query) use ($companyEventId) {
                $query->where('event_id', $companyEventId);
            }
        ])->first();

        $userEvent->update(['email_verified_at' => date('Y-m-d H:i:s')]);

        return $userEvent;
    }

    public function createUserEvent(User $user, CompanyEvent $event, string $token): ?UserEvent
    {
        try {
            $userEvent = UserEvent::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'token' => $token
            ]);
            Mail::to($user)->send(new UserEventRegistered($event, $user, $token));

            return $userEvent;
        } catch (\Exception $e) {
            return null;
        }
    }
}