<?php

use Tringuyen\CarForRent\Bootstrap\Router;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Controller\UserController;

Router::get('/', [new SiteController(),'home']);
Router::get('/home', [new SiteController(),'home']);
Router::get('/contact', 'contact');
Router::get('/login', [new UserController(),'login']);
Router::post('/login', [new UserController(),'login']);
Router::post('/logout', [new UserController(),'logout']);
