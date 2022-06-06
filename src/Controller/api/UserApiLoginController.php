<?php

namespace Tringuyen\CarForRent\Controller\api;

use Tringuyen\CarForRent\Http\Response;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Service\TokenService;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Tranformer\UserTranformer;
use Tringuyen\CarForRent\Validator\LoginValidator;

class UserApiLoginController
{
    private UserService $userService;
    private UserLoginRequest $userLoginRequest;
    private UserLoginResponse $userLoginResponse;
    private LoginValidator $userLoginValidator;
    private UserTranformer $userTransformer;
    private TokenService $tokenService;


    public function __construct(UserService $userService, UserLoginRequest $request, UserLoginResponse $response, LoginValidator $userLoginValidator, UserTranformer $userTransformer, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->userLoginRequest = $request;
        $this->userLoginResponse = $response;
        $this->userLoginValidator = $userLoginValidator;
        $this->userTransformer = $userTransformer;
        $this->tokenService = $tokenService;
    }

    public function login()
    {
        try {
            $errors = '';
            if ($this->userLoginRequest->getMethod() === 'POST') {
                $this->userLoginRequest->fromArray($this->userLoginRequest->getJSONBody());
                $this->userLoginValidator->validateUserLogin($this->userLoginRequest);
                $isLoginSuccess = $this->userService->login($this->userLoginRequest);
                if ($isLoginSuccess != null) {
                    $this->userLoginResponse = $isLoginSuccess;
                    $accessToken = $this->tokenService->create($this->userLoginResponse->getUser());
                    return $this->userLoginResponse->toJson(
                        ['data' => $this->userTransformer->userToArray($this->userLoginResponse->getUser()),
                            'message' => $errors,
                            'token' => $accessToken],
                        Response::HTTP_OK
                    );
                }
                $errors = 'Username or Password is invalid!';
                return $this->userLoginResponse->toJson(
                    ['message' => $errors],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (\Exception $exception) {
            // logging
            $errors = $exception->getMessage();
            return $this->userLoginResponse->toJson(
                ['message' => $errors],
                Response::HTTP_BAD_REQUEST
            );
        }
        return $this->userLoginResponse->toJson(
            ['message' => 'Error!'],
            Response::HTTP_FORBIDDEN
        );
    }
}
