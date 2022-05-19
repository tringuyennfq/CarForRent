<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\Application;
use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Service\UserService;

class UserController
{
    private $userService;
    private $sessionService;

    public function __construct()
    {
        $connection = DatabaseConnect::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function login()
    {

        return View::renderView('User/login', [
            'title' => 'Login',
            'id' => '',
            'password' => ''
        ]);
    }

    public function handleLogin()
    {
        $body = Application::$app->request->getBody();
        $request = new UserLoginRequest();
        $request->username = $body['username'];
        $request->password = $body['password'];

        try {
            $response = $this->userService->login($request);
            $_SESSION['username'] = $response->user->username;
            View::redirect('/');
        } catch (ValidationException $exception) {
            return View::renderView('User/login', [
             'title' => 'Login',
             'username' => $_POST['username'],
             'password' => $_POST['password'],
             'error' => $exception->getMessage()
            ]);
        }
    }

    public function logout()
    {
        unset($_SESSION['username']);
        View::redirect('/');
    }
}
