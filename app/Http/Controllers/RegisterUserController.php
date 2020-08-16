<?php

namespace App\Http\Controllers;

use App\CompanyEvent;
use App\Mail\UserEventRegistered;
use App\User;
use App\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterUserController extends Controller
{
    public function create(Request $request)
    {
        $this->eventRegistrationValidator->validateEmailAndEvent($request);
        $email = $request->get('email');
        $user = $this->createUser($email);
        $companyEvent = CompanyEvent::find($request->get('companyEvent'));
        $userEvent = $this->createUserEvent($user, $companyEvent);
        $eventAlert = $this->getEventAlertMessage($userEvent);

        return redirect("$companyEvent->url?eventAlert=$eventAlert[0]&eventAlertType=$eventAlert[1]");

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
            Mail::to($user)->send(new UserEventRegistered($event, $user));

            return $userEvent;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function getEventAlertMessage($userEvent): array
    {
        if (empty($userEvent)) {
            return [urlencode('This email has been used for registration'), 'fail'];
        }

        return [urlencode('Thank you for registering we send your qrcode'), 'success'];
    }

    private function getNameFromEmail(string $email): string
    {
        $arr = explode("@", $email, 2);

        return ucfirst($arr[ 0 ]);
    }
}
