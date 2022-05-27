<?php

namespace Tringuyen\CarForRent\Controller\api;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Http\Response;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Tranformer\UserTranformer;
use Tringuyen\CarForRent\Validator\LoginValidator;

class UserApiLoginController
{
    private UserService $userService;
    private UserLoginRequest $userLoginRequest;
    private UserLoginResponse $userLoginResponse;
    private LoginValidator $userLoginValidator;
    private UserTranformer $userTranformer;



    public function __construct(UserService $userService, UserLoginRequest $request, UserLoginResponse $response, LoginValidator $userLoginValidator,UserTranformer $userTranformer)
    {
        $this->userService = $userService;
        $this->userLoginRequest = $request;
        $this->userLoginResponse = $response;
        $this->userLoginValidator = $userLoginValidator;
        $this->userTranformer = $userTranformer;

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
                    return $this->userLoginResponse->toJson(
                        [
                            'data'=>$this->userTranformer->UserToArray($this->userLoginResponse->getUser()),
                            'message'=>$errors
                        ], Response::HTTP_OK
                    );
                }
                $errors = 'Username or Password is invalid!';
                return $this->userLoginResponse->toJson(
                    [
                        'message'=>$errors
                    ], Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (\Exception $exception) {
            // logging
            $errors = $exception->getMessage();
            return $this->userLoginResponse->toJson(
                [
                    'message'=>$errors
                ],Response::HTTP_BAD_REQUEST);
        }
    }
}