<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Repository\CarRepository;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }
}