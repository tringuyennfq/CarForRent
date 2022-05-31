<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserRegisterRequest;
use function PHPUnit\Framework\throwException;

class RegisterValidator extends Validator
{
    /**
     * @param UserRegisterRequest $userRegisterRequest
     * @return bool|array
     */
    public function validateUserRegister(UserRegisterRequest $userRegisterRequest): bool|array
    {
        $val = new Validator();
        $val->name('username')->value($userRegisterRequest->getUsername())->required();
        $val->name('password')->value($userRegisterRequest->getPassword())->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();

        $val->name('confirmPassword')->value($userRegisterRequest->getConfirmPassword())->equal($userRegisterRequest->getPassword())->required();
        if($val->isSuccess()){
            return true;
        }
        return $val->getErrors();
    }
}