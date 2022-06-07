<?php

namespace Tringuyen\CarForRent\Validator;

use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Transfer\UserRegisterRequest;

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
        if ($existUser != null) {
            $val->errors['username'] = 'Username already exists!';
        }
        $val->name('username')->value($userRegisterRequest->getUsername())->required()->min(6)->max(50);
        $val->name('password')->value($userRegisterRequest->getPassword())->required()->min(6)->max(50);

        $val->name('confirmPassword')->value($userRegisterRequest->getConfirmPassword())->equal($userRegisterRequest->getPassword())->required();
        if ($val->isSuccess()) {
            return true;
        }
        return $val->getErrors();
    }
}
