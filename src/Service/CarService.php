<?php

namespace Tringuyen\CarForRent\Service;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Tringuyen\CarForRent\Exception\UploadFileException;
use Tringuyen\CarForRent\Repository\CarRepository;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

}