<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Exception\LoginException;
use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Model\UserLoginResponse;
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
        $this->userLoginRequest->fromArray();
        $errors = '';

        try {
            if ($this->userLoginRequest->getMethod() === 'POST') {
                $this->userLoginValidator->validateUserLogin($this->userLoginRequest);
                $this->userLoginResponse = $this->userService->login($this->userLoginRequest);
                $_SESSION['username'] = $this->userLoginResponse->getUser()->getUsername();

                View::redirect('/');
            }
        } catch (ValidationException|LoginException $exception) {
            // logging
            $errors = $exception->getMessage();
        }

        return View::renderView('User/login', [
            'title' => 'Login',
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'error' => $errors
        ]);
//             return View::renderView('User/login', [
//            'title' => 'Login',
//            'username' => $_POST['username'] ?? '',
//            'password' => $_POST['password'] ?? '',
//            'error' => ''
//        ]);

    }

//    public function handleLogin()
//    {
//        $body = Application::$app->request->getBody();
//        $request = new UserLoginRequest();
//        $request->username = $body['username'];
//        $request->password = $body['password'];
//
//        try {
//            $userLoginValidator = new LoginValidator();
//            $userLoginValidator->validateUserLogin($request);
//            $response = $this->userService->login($request);
//            $_SESSION['username'] = $response->user->username;
//            View::redirect('/');
//        } catch (ValidationException $exception) {
//            return View::renderView('User/login', [
//             'title' => 'Login',
//             'username' => $_POST['username'],
//             'password' => $_POST['password'],
//             'error' => $exception->getMessage()
//            ]);
//        }
//    }

    public function logout()
    {
        unset($_SESSION['username']);
        View::redirect('/');
    }
}
