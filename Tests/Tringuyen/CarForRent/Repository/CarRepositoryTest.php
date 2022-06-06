<?php

namespace Test\Tringuyen\CarForRent\Repository;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\Car;
use Tringuyen\CarForRent\Repository\CarRepository;

class CarRepositoryTest extends TestCase
{
    private function getCar(
        int $id,
        string $name,
        string $brand,
        int $price,
        string $color,
        string $img,
        string $description
    ): Car
    {
        $car = new Car();
        $car->setId($id);
        $car->setName($name);
        $car->setBrand($brand);
        $car->setPrice($price);
        $car->setColor($color);
        $car->setImagePath($img);
        $car->setDescription($description);
        return $car;
    }

    /**
     * @param array $params
     * @param mixed $expected
     * @return void
     * @dataProvider findByIdDataProvider
     */
    public function testFindById(array $params, mixed $expected)
    {
        $carRepositoryTest = new CarRepository();
        $result = $carRepositoryTest->findById($params['id']);
        $this->assertEquals($expected,$result);
    }

    public function findByIdDataProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'id' => 1,
                ],
                'expected' => $this->getCar(1,'Camper Cabin', 'Ford', 120, 'red','https://tricarrent.s3.ap-southeast-1.amazonaws.com/Ford-campercabin.jpeg' ,'Car descriptions',)
            ],
            'unhappy-case-1' => [
                'params' => [
                    'id' => 1231231,
                ],
                'expected' => null
            ]
        ];
    }

}