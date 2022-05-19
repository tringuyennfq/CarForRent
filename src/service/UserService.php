<?php

namespace Tringuyen\CarForRent\service;

use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\model\UserLoginRequest;
use Tringuyen\CarForRent\model\UserLoginResponse;
use Tringuyen\CarForRent\repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ValidationException
     */
    public function login(UserLoginRequest $request)
    {
        $this->validateUserLogin($request);
        $user = $this->userRepository->findByUsername($request->username);
        if ($user == null) {
            throw new ValidationException("Invalid username");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Wrong password");
        }
    }

    /**
     * @throws ValidationException
     */
    private function validateUserLogin(UserLoginRequest $request)
    {
        if (
            empty($request->username) ||
            empty($request->password)
        ) {
            throw new ValidationException("Username and password cannot be empty");
        }
    }
}
