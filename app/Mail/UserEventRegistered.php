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
     */
    public function __construct(CompanyEvent $companyEvent, User $user)
    {
        $this->companyEvent = $companyEvent;
        $this->user = $user;
        $this->url = env('APP_URL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('event_register');
    }
}
