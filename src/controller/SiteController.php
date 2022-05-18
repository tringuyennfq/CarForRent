<?php

namespace Tringuyen\CarForRent\controller;

use Tringuyen\CarForRent\bootstrap\Application;
use Tringuyen\CarForRent\bootstrap\View;

class  SiteController
{
    public function home()
    {
        $params = [
            'name'=> "Tri Nguyen"
        ];
        return View::renderView('home',$params);
    }

    public function login()
    {
        $params = [
            'name'=> "Tri Nguyen"
        ];
        return View::renderView('login',$params);
    }

    public function handleLogin()
    {
        return "Handling Login";
    }

}