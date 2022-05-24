<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Exception\LoginException;
use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
use Tringuyen\CarForRent\Service\SessionService;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Validator\LoginValidator;

class UserLoginController
{
    private UserService $userService;
    private UserLoginRequest $userLoginRequest;
    private UserLoginResponse $userLoginResponse;
    private LoginValidator $userLoginValidator;


    public function __construct(UserService $userService, UserLoginRequest $request, UserLoginResponse $response,LoginValidator $userLoginValidator)
    {
        $this->userService = $userService;
        $this->userLoginRequest = $request;
        $this->userLoginResponse = $response;
        $this->userLoginValidator = $userLoginValidator;

    }

    public function login()
    {
        try {
            $errors = '';
            if ($this->userLoginRequest->getMethod() === 'POST') {
                $this->userLoginRequest->fromArray($this->userLoginRequest->getBody());
                $this->userLoginValidator->validateUserLogin($this->userLoginRequest);
                $isLoginSuccess = $this->userService->login($this->userLoginRequest);
                if($isLoginSuccess){
                    $_SESSION['username'] = $this->userLoginRequest->getUsername();
                    View::redirect('/');
                }
                $errors = 'Username or Password is invalid!';
            }
        } catch (\Exception $exception) {
            // logging
            $errors = $exception->getMessage();
        }

        return View::renderView('User/login', [
            'title' => 'Login',
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'error' => $errors
        ]);
    }

    public function logout()
    {
        unset($_SESSION['username']);
        View::redirect('/');
    }
}