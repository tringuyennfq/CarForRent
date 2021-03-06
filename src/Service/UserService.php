<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Exception\RegisterExeption;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Transfer\UserLoginRequest;
use Tringuyen\CarForRent\Transformer\UserLoginResponse;
use Tringuyen\CarForRent\Transfer\UserRegisterRequest;

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
     * @param UserLoginRequest $request
     * @return UserLoginResponse|null
     */
    public function login(UserLoginRequest $request): ?UserLoginResponse
    {

        $existUser = $this->userRepository->findByUsername($request->getUsername());
        if ($existUser && password_verify($request->getPassword(), $existUser->getPassword())) {
            $userLoginResponse = new UserLoginResponse();
            $userLoginResponse->setUser($existUser);
            return $userLoginResponse;
        }
        return null;
    }


    /**
     * @param UserRegisterRequest $userRegisterRequest
     * @return bool
     * @throws RegisterExeption
     */
    public function register(UserRegisterRequest $userRegisterRequest): bool
    {
        if ($this->userRepository->insertUser($userRegisterRequest)) {
            return true;
        }
            throw new RegisterExeption('Register Error: There was something wrong!');
    }
}
