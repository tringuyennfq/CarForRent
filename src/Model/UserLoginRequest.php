<?php

namespace Tringuyen\CarForRent\Model;

use Tringuyen\CarForRent\Bootstrap\Request;

class UserLoginRequest
{
    public $username;
    public $password;

    public function isPost(): bool
    {
        $request = new Request();
        if ($request->getMethod() === 'POST') {
            return true;
        }
        return false;
    }
}
