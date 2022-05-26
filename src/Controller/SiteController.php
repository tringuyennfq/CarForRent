<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;

class SiteController
{
    /**
     * @return array|string
     */
    public function home(): array | string
    {
        $params = [
            'name' => "Tri Nguyen"
        ];
        return View::renderView('home', $params);
    }
}
