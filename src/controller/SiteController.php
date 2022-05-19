<?php

namespace Tringuyen\CarForRent\controller;

use Dotenv\Dotenv;
use Tringuyen\CarForRent\bootstrap\View;

class SiteController
{
    public function home()
    {
        $params = [
            'name' => "Tri Nguyen"
        ];
        return View::renderView('home', $params);
    }
}
