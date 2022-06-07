<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Transfer\Car;

class CarTest extends TestCase
{
    public function testGetSet()
    {
        $param = [
            'id' => 1,
            'name' => 'name',
            'brand' => 'brand',
            'price' => 12,
            'color' => 'color',
            'description' => 'description',
            'imagePath' => 'imagePath'
        ];
        $resultCar = new Car();
        $resultCar->setId($param['id']);
        $resultCar->setName($param['name']);
        $resultCar->setBrand($param['brand']);
        $resultCar->setPrice($param['price']);
        $resultCar->setColor($param['color']);
        $resultCar->setDescription($param['description']);
        $resultCar->setImagePath($param['imagePath']);

        $this->assertEquals($resultCar->getId(), $param['id']);
        $this->assertEquals($resultCar->getName(), $param['name']);
        $this->assertEquals($resultCar->getBrand(), $param['brand']);
        $this->assertEquals($resultCar->getPrice(), $param['price']);
        $this->assertEquals($resultCar->getColor(), $param['color']);
        $this->assertEquals($resultCar->getDescription(), $param['description']);
        $this->assertEquals($resultCar->getImagePath(), $param['imagePath']);
    }
}
