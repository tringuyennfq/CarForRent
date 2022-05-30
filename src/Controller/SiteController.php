<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Repository\CarRepository;

class SiteController
{
    /**
     * @return array|string
     */
    public function home(): array | string
    {
        $carRepository = new CarRepository();
        $carList = $carRepository->findAll(10,0);
        $params = [
            'name' => "Tri Nguyen",
            'carList' => $carList
        ];
        return View::renderView('home', $params);
    }
}
