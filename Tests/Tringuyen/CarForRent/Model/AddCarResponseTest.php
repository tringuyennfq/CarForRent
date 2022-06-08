<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Transformer\AddCarResponse;

class AddCarResponseTest extends TestCase
{
    public function testFromArray()
    {
        $testArray = [
            'name' => 'name',
            'brand' => 'brand',
            'price' => 0,
            'color' => 'color',
            'description' => 'description',
            'image' => 'image'
        ];
        $testAddCarResponse = new AddCarResponse();
        $testAddCarResponse->fromArray($testArray);
        $this->assertEquals($testAddCarResponse->getName(), $testArray['name']);
        $this->assertEquals($testAddCarResponse->getBrand(), $testArray['brand']);
        $this->assertEquals($testAddCarResponse->getPrice(), $testArray['price']);
        $this->assertEquals($testAddCarResponse->getColor(), $testArray['color']);
        $this->assertEquals($testAddCarResponse->getDescription(), $testArray['description']);
        $this->assertEquals($testAddCarResponse->getImage(), $testArray['image']);
    }
}