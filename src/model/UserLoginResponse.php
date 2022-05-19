<?php

namespace Tringuyen\CarForRent\model;

class UserLoginResponse
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }
}
