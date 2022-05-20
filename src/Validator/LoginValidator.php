<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;

class LoginValidator
{
    /**
     * @throws ValidationException
     */
    public function validateUserLogin(UserLoginRequest $request)
    {
        if (
            empty($request->username) ||
            empty($request->password)
        ) {
            throw new ValidationException("Username and password cannot be empty");
        }
    }
}
