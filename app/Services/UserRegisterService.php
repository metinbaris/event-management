<?php

namespace App\Services;

use App\CompanyEvent;
use App\Traits\NameFromEmail;
use App\User;
use App\UserEvent;

class UserRegisterService extends UserEventService
{
    use NameFromEmail;

    protected $name;
    protected $email;
    protected $token;
    protected $companyEvent;
    protected $userEvent;

    /**
     * @var User
     */
    protected $user;

    public function setUserRegistrationData($email, $token, $companyEventSlug): self
    {
        $name = $this->getNameFromEmail($email);
        $this->setEmail($email);
        $this->setName($name);
        $this->setToken($token);
        $this->setCompanyEvent($companyEventSlug);

        return $this;
    }

    public function registerUserToEvent(): self
    {
        $this->registerUser();
        $userEvent = $this->createUserEvent($this->user, $this->companyEvent, $this->token);
        $this->setUserEvent($userEvent);

        return $this;
    }

    public function registerUser()
    {
        $this->user = $this->firstOrCreateUser($this->email, $this->name);
    }

    /**
     * @param UserEvent|null $userEvent
     */
    protected function setUserEvent(?UserEvent $userEvent)
    {
        $this->userEvent = $userEvent;
    }

    /**
     * @return UserEvent|null
     */
    public function getUserEvent()
    {
        return $this->userEvent;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getCompanyEvent()
    {
        return $this->companyEvent;
    }

    /**
     * @param string $companyEventSlug
     */
    public function setCompanyEvent(string $companyEventSlug): void
    {
        $this->companyEvent = CompanyEvent::whereSlug($companyEventSlug)->first();
    }
}
