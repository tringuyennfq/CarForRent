<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Model\UserRegisterRequest;
use Tringuyen\CarForRent\Repository\UserRepository;

class RegisterValidator extends Validator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRegisterRequest $userRegisterRequest
     * @return bool|array
     */
    public function validateUserRegister(UserRegisterRequest $userRegisterRequest): bool | array
    {
        $val = new Validator();
        $existUser = $this->userRepository->findByUsername($userRegisterRequest->getUsername());
        if($existUser != null){
            $val->errors['username'] = 'Username already exists!';
        }
        $val->name('username')->value($userRegisterRequest->getUsername())->required()->max(50);
        $val->name('password')->value($userRegisterRequest->getPassword())->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();

        $val->name('confirmPassword')->value($userRegisterRequest->getConfirmPassword())->equal($userRegisterRequest->getPassword())->required();
        if ($val->isSuccess()) {
            return true;
        }
        return $val->getErrors();
    }
}
