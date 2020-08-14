<?php

namespace App\Http\Controllers;

use App\CompanyEvent;
use App\User;
use App\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create(Request $request)
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        //$companyEvent = CompanyEvent::find($request->get('companyEvent'));
        //$user = $this->createUser($email);
        //$userEvent = $this->createUserEvent($user, $companyEvent);

        return response(['email' => $userEvent]);
    }

    private function getNameFromEmail(string $email): string
    {
        $arr = explode("@", $email, 2);

        return ucfirst($arr[ 0 ]);
    }

    private function createUser(string $email): User
    {
        $user = User::firstOrNew([
            'name' => $this->getNameFromEmail($email),
            'password' => Hash::make('123456'),
            'email' => $email,
        ]);

        return $user;
    }

    private function createUserEvent(User $user, CompanyEvent $event): UserEvent
    {
        $userEvent = UserEvent::firstOrCreate([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        return $userEvent;
    }
}
