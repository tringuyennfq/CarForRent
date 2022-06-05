<?php

namespace Tringuyen\CarForRent\Controller;

use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Service\CarService;

class SiteController
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @return array|string
     */
    public function home(): array | string
    {
        $carList = $this->carService->getAll();
        $params = [
            'name' => "Tri Nguyen",
            'carList' => $carList
        ];
        return View::renderView('home', $params);
    }
}
