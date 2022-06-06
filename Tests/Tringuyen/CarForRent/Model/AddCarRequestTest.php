<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\AddCarRequest;

class AddCarRequestTest extends TestCase
{
    public function testGetSet()
    {
        $param = [
            'name' => 'name',
            'brand' => 'brand',
            'price' => 12,
            'color' => 'color',
            'description' => 'description',
        ];
        $resultAddCarRequest = new AddCarRequest();
        $resultAddCarRequest->setName($param['name']);
        $resultAddCarRequest->setBrand($param['brand']);
        $resultAddCarRequest->setPrice($param['price']);
        $resultAddCarRequest->setColor($param['color']);
        $resultAddCarRequest->setDescription($param['description']);

        $this->assertEquals($resultAddCarRequest->getName(), $param['name']);
        $this->assertEquals($resultAddCarRequest->getBrand(), $param['brand']);
        $this->assertEquals($resultAddCarRequest->getPrice(), $param['price']);
        $this->assertEquals($resultAddCarRequest->getColor(), $param['color']);
        $this->assertEquals($resultAddCarRequest->getDescription(), $param['description']);
    }

    public function testFromArray()
    {
        $param = [
            'name' => 'name',
            'brand' => 'brand',
            'price' => '123',
            'color' => 'color',
            'description' => 'description',
        ];
        $resultAddCarRequest =  new AddCarRequest();
        $resultAddCarRequest->fromArray($param);
        $expectedAddCarRequest = new AddCarRequest();
        $expectedAddCarRequest->setSelf($param['name'],$param['brand'],(int)$param['price'],$param['color'],$param['description']);
        $this->assertEquals($expectedAddCarRequest,$resultAddCarRequest);
    }
}