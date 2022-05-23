<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Exception\LoginException;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @param UserRepository $userRepository
     */
    public function setUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws LoginException
     */
    public function login(UserLoginRequest $request)
    {

        $user = $this->userRepository->findByUsername($request->getUsername());
        if ($user == null) {
            throw new LoginException("Invalid Username or Password");
        }

        if (password_verify($request->getPassword(), $user->getPassword())) {
            $response = new UserLoginResponse();
            $response->setUser($user);
            return $response;
        } else {
            throw new LoginException("Invalid Username or Password");
        }
    }
}
