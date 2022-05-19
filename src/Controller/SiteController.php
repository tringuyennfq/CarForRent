<?php

namespace Tringuyen\CarForRent\Controller;

use Dotenv\Dotenv;
use Tringuyen\CarForRent\Bootstrap\View;

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
