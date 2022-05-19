<?php

namespace Tringuyen\CarForRent\Model;

class UserLoginResponse
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }
}
