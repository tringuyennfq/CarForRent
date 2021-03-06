<?php

namespace Tringuyen\CarForRent\Transformer;

use Tringuyen\CarForRent\Http\Response;
use Tringuyen\CarForRent\Model\User;

class UserLoginResponse extends Response
{
    /**
     * @var User
     */
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
