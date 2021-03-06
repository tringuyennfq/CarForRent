<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Service\SessionService;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Transfer\UserLoginRequest;
use Tringuyen\CarForRent\Transformer\UserLoginResponse;
use Tringuyen\CarForRent\Validator\LoginValidator;

class UserLoginController
{
    private UserService $userService;
    private UserLoginRequest $userLoginRequest;
    private UserLoginResponse $userLoginResponse;
    private LoginValidator $userLoginValidator;
    private SessionService $sessionService;


    public function __construct(UserService $userService, UserLoginRequest $request, UserLoginResponse $response, LoginValidator $userLoginValidator, SessionService $sessionService)
    {
        $this->userService = $userService;
        $this->userLoginRequest = $request;
        $this->userLoginResponse = $response;
        $this->userLoginValidator = $userLoginValidator;
        $this->sessionService = $sessionService;
    }

    public function login()
    {
        if (isset($_SESSION['username'])) {
            return View::redirect('404');
        }
        try {
            $errors = '';
            if ($this->userLoginRequest->isPostMethod()) {
                $this->userLoginRequest->fromArray($this->userLoginRequest->getBody());
                $this->userLoginValidator->validateUserLogin($this->userLoginRequest);
                $isLoginSuccess = $this->userService->login($this->userLoginRequest);
                if ($isLoginSuccess != null) {
                    $this->userLoginResponse = $isLoginSuccess;
                    $this->sessionService->setUserId($isLoginSuccess->getUser()->getId());
                    return View::redirect('/');
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
        $isLogout = $this->sessionService->destroyUser();
        if ($isLogout) {
            return View::redirect('/login');
        }
        return View::redirect('/');
    }
}
