<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Exception\RegisterExeption;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Model\UserRegisterRequest;
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
        $existUser = $this->userRepository->findByUsername($userRegisterRequest->getUsername());
        if($existUser == null){
            $user = new User();
            $user->setUsername($userRegisterRequest->getUsername());
            $user->setPassword($userRegisterRequest->getPassword());
            $this->userRepository->insertUser($user);
            return true;
        }
        throw new RegisterExeption('Username already exists');
    }
}
