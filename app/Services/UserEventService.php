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

    public function verifyUserEmail(User $user)
    {
        $user->update(['email_verified_at' => date('Y-m-d H:i:s')]);
    }

    public function verifyUserEvent(int $userId, string $companyEventSlug)
    {
        $companyEvent = CompanyEvent::whereSlug($companyEventSlug)->first();
        $userEvent = UserEvent::select('*')
            ->whereUserId($userId)
            ->whereEventId($companyEvent->id)
            ->whereNull('email_verified_at')
            ->firstOrFail();

        $userEvent->update(['email_verified_at' => date('Y-m-d H:i:s')]);
    }

    public function createUserEvent(User $user, CompanyEvent $companyEvent, string $token): ?UserEvent
    {
        try {
            $userEvent = UserEvent::create([
                'user_id' => $user->id,
                'event_id' => $companyEvent->id,
                'token' => $token
            ]);
            Mail::to($user)->send(new UserEventRegistered($companyEvent, $user, $token));

            return $userEvent;
        } catch (\Exception $e) {
            return null;
        }
    }
}