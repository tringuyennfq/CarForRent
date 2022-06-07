<?php

namespace Test\Tringuyen\CarForRent\Validator;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Transfer\AddCarRequest;
use Tringuyen\CarForRent\Validator\AddCarValidator;

class AddCarValidatorTest extends TestCase
{
    public function testValidateAddCarSuccess()
    {
        $addCarRequest = new AddCarRequest();
        $addCarRequest->setSelf('car1','brand',123,'color','description');
        $result = new AddCarValidator();
        $this->assertTrue($result->validateCarAdd($addCarRequest));
    }
    public function testValidateAddCarFailed()
    {
        $addCarRequest = new AddCarRequest();
        $addCarRequest->setSelf('','brand','123','color','description');
        $addCarValidator = new AddCarValidator();
        $result = $addCarValidator->validateCarAdd($addCarRequest);
        $expected = ['name' => 'name field required.'];
        $this->assertEquals($result,$expected);
    }
}