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

    public $companyEvent;
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
        $connectionUrl = env('CONNECTION_URL');
        $this->url = "$connectionUrl/generateqrcode?email=$user->email&companyEvent=$companyEvent->slug&token=$token";
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Confirmation & Event Registration')->view('emails.event_register');
    }
}
