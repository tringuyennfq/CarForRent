<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Exception\RegisterExeption;
use Tringuyen\CarForRent\Service\UserService;
use Tringuyen\CarForRent\Transfer\UserRegisterRequest;
use Tringuyen\CarForRent\Transformer\UserRegisterResponse;
use Tringuyen\CarForRent\Validator\RegisterValidator;

class UserRegisterController
{
    private UserService $userService;
    private UserRegisterRequest $userRegisterRequest;
    private UserRegisterResponse $userRegisterResponse;
    private RegisterValidator $userRegisterValidator;

    public function __construct(UserService $userService, UserRegisterRequest $userRegisterRequest, UserRegisterResponse $userRegisterResponse, RegisterValidator $userRegisterValidator)
    {
        $this->userService = $userService;
        $this->userRegisterRequest = $userRegisterRequest;
        $this->userRegisterResponse = $userRegisterResponse;
        $this->userRegisterValidator = $userRegisterValidator;
    }

    public function register()
    {
        if (isset($_SESSION['username'])) {
            return View::redirect('404');
        }
        try {
            $errors = [];
            $success = false;
            if ($this->userRegisterRequest->isPostMethod()) {
                $this->userRegisterRequest->fromArray($this->userRegisterRequest->getBody());
                $validate = $this->userRegisterValidator->validateUserRegister($this->userRegisterRequest);
                if ($validate === true) {
                    $this->userService->register($this->userRegisterRequest);
                    $success = true;
                }
                $errors = $validate;
            }
        } catch (RegisterExeption $exception) {
            $errors['exception'] = $exception->getMessage();
        }
            return View::renderView('User/register', [
                'title' => 'Register',
                'username' => $_POST['username'] ?? '',
                'password' => $_POST['password'] ?? '',
                'confirmPassword' => $_POST['confirmPassword'] ?? '',
                'error' => $errors,
                'success' => $success

            ]);
    }
}
