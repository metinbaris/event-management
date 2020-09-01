<?php

namespace App\Mail;

use App\CompanyEvent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEventRegistered extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var CompanyEvent
     */
    public $companyEvent;
    /**
     * @var User
     */
    public $user;

    public $url;

    /**
     * Create a new message instance.
     * @param CompanyEvent $companyEvent
     * @param User $user
     * @param string $token
     */
    public function __construct(CompanyEvent $companyEvent, User $user, string $token)
    {
        $this->companyEvent = $companyEvent;
        $this->user = $user;
        $appUrl = env('CONNECTION_URL');
        $this->url = "$appUrl/generateqrcode?email=$user->email&companyEvent=$companyEvent->id&token=$token";
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Confirmation & Event Registration')->view('event_register');
    }
}
