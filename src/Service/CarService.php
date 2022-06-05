<?php

namespace Tringuyen\CarForRent\Service;

use Tringuyen\CarForRent\Model\AddCarResponse;
use Tringuyen\CarForRent\Repository\CarRepository;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param AddCarResponse $addCarResponse
     * @return bool
     */
    public function save(AddCarResponse $addCarResponse)
    {
        $insertCar = $this->carRepository->insertCar($addCarResponse);
        return $insertCar;
    }
    public function getAll(int $limit = 10, int $offset = 0)
    {
        return $this->carRepository->findAll($limit, $offset);
    }
}
