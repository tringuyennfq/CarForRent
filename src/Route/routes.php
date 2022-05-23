<?php

use Tringuyen\CarForRent\Bootstrap\Router;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Controller\UserLoginController;

Router::get('/', [SiteController::class,'home']);
Router::get('/home', [SiteController::class,'home']);
Router::get('/contact', 'contact');
Router::get('/login', [UserLoginController::class,'login']);
Router::post('/login', [UserLoginController::class,'login']);
Router::post('/logout', [UserLoginController::class,'logout']);
