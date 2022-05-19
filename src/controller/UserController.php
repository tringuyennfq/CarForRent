<?php

namespace Tringuyen\CarForRent\controller;

use Tringuyen\CarForRent\bootstrap\Application;
use Tringuyen\CarForRent\bootstrap\View;
use Tringuyen\CarForRent\database\DatabaseConnect;
use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\model\UserLoginRequest;
use Tringuyen\CarForRent\repository\UserRepository;
use Tringuyen\CarForRent\service\UserService;

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
