<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Validator\LoginValidator;

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
}
