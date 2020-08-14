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
        $companyEvent = CompanyEvent::find($request->get('companyEvent'));
        $user = $this->createUser($email);
        $userEvent = $this->createUserEvent($user, $companyEvent);

        if (empty($userEvent)) {
            return response(['You have already registered']);
        }

        return response($userEvent);
    }

    private function getNameFromEmail(string $email): string
    {
        $arr = explode("@", $email, 2);

        return ucfirst($arr[ 0 ]);
    }

    private function createUser(string $email): User
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            ['password' => Hash::make('123456'), 'name' => $this->getNameFromEmail($email)]
        );

        return $user;
    }

    private function createUserEvent(User $user, CompanyEvent $event): ?UserEvent
    {
        try {
            $userEvent = UserEvent::create([
                'user_id' => $user->id,
                'event_id' => $event->id
            ]);

            return $userEvent;
        } catch (\Exception $e) {
            return null;
        }
    }
}
