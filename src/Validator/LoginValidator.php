<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;

class LoginValidator
{
    /**
     * @throws ValidationException
     */
    public function validateUserLogin(UserLoginRequest $request): bool
    {
        if (
            empty($request->getUsername()) ||
            empty($request->getPassword())
        ) {
            throw new ValidationException("Username and password cannot be empty");
        }
        return true;
    }
}
