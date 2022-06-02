<?php

namespace Tringuyen\CarForRent\Repository;

use PDO;
use Exception;
use Tringuyen\CarForRent\Database\DatabaseConnect;
use Tringuyen\CarForRent\Model\AddCarResponse;
use Tringuyen\CarForRent\Model\Car;

class CarRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnect::getConnection();
    }

    public function findById(int $id): ?Car
    {
        $statement = $this->connection->prepare("SELECT * FROM car WHERE car_id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $car = new Car();
                $car->setId($row['car_id']);
                $car->setName($row['name']);
                $car->setBrand($row['brand']);
                $car->setColor($row['color']);
                $car->setPrice($row['price']);
                $car->setDescription($row['description']);
                return $car;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(int $limit, int $offset)
    {
        $statement = $this->connection->prepare("SELECT * FROM car LIMIT :offset,:limit");
        $statement->bindValue('offset', $offset, PDO::PARAM_INT);
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        $carList = [];
        $row = $statement->fetchAll();
        foreach ($row as $result) {
            $car = new Car();
            $car->setId($result['car_id']);
            $car->setName($result['name']);
            $car->setBrand($result['brand']);
            $car->setColor($result['color']);
            $car->setPrice($result['price']);
            $car->setDescription($result['description']);
            $car->setImagePath($result['img']);
            array_push($carList, $car);
        }
        return $carList;
    }

    public function insertCar(AddCarResponse $carResponse)
    {
        $statement = $this->connection->prepare("INSERT INTO car (name, brand, price, color, img, description) VALUES (?,?,?,?,?,?)");
        try {
            $statement->execute([
                $carResponse->getName(),
                $carResponse->getBrand(),
                $carResponse->getPrice(),
                $carResponse->getColor(),
                $carResponse->getImage(),
                $carResponse->getDescription()
            ]);
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
