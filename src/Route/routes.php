<?php

use Tringuyen\CarForRent\bootstrap\Router;
use Tringuyen\CarForRent\controller\SiteController;

Router::get('/',[new SiteController(),'home']);
Router::get('/home',[new SiteController(),'home']);
Router::get('/contact', 'contact');
Router::get('/login', [new SiteController(),'login']);
Router::post('/login',[new SiteController(),'handleLogin']);
