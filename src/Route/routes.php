<?php

use Tringuyen\CarForRent\bootstrap\Router;
use Tringuyen\CarForRent\controller\SiteController;
use Tringuyen\CarForRent\controller\UserController;

Router::get('/', [new SiteController(),'home']);
Router::get('/home', [new SiteController(),'home']);
Router::get('/contact', 'contact');
Router::get('/login', [new UserController(),'login']);
Router::post('/login', [new UserController(),'handleLogin']);
Router::get('/logout', [new UserController(),'logout']);
