<?php

use Tringuyen\CarForRent\Bootstrap\Router;
use Tringuyen\CarForRent\Controller\api\UserApiLoginController;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Controller\UserLoginController;
use Tringuyen\CarForRent\Controller\UserRegisterController;

Router::get('/', [SiteController::class, 'home']);
Router::get('/home', [SiteController::class, 'home']);
Router::get('/contact', 'contact');
Router::get('/login', [UserLoginController::class, 'login']);
Router::post('/login', [UserLoginController::class, 'login']);
Router::post('/logout', [UserLoginController::class, 'logout']);
Router::get('/register', [UserRegisterController::class, 'register']);
Router::post('/register', [UserRegisterController::class, 'register']);

Router::post('/api/login', [UserApiLoginController::class, 'login']);
