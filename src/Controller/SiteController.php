<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Repository\CarRepository;

class SiteController
{
    protected CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return array|string
     */
    public function home(): array | string
    {
        $carList = $this->carRepository->findAll(10, 0);
        $params = [
            'name' => "Tri Nguyen",
            'carList' => $carList
        ];
        return View::renderView('home', $params);
    }
}
