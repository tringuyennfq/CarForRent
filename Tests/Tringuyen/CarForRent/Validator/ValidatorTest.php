<?php

namespace Test\Tringuyen\CarForRent\Validator;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Validator\Validator;

class ValidatorTest extends TestCase
{
    public function testValidatorSuccess()
    {
        $validator = new Validator();
        $validator->name('username')->value('khaitri')->required()->max(50)->min(5);
        $validator->name('price')->value(123)->required()->is_numeric();
        $this->assertTrue($validator->isSuccess());
    }
    public function testValidatorFailed()
    {
        $validator = new Validator();
        $validator->name('username')->value('khaitri')->max(5);
        $validator->name('password')->value('khaitri')->min(10);
        $validator->name('confirmPassword')->value('khaitri')->equal('aloalo');
        $validator->name('brand')->value(null)->required();
        $validator->name('price')->value(null)->is_numeric();
        $validator->name('min')->value(1)->min(5);
        $validator->name('max')->value(5)->max(3);
        $expectedArray = [
            'username' => "username field is more than maximum value",
            'password' => "password field is less than minimum value",
            'confirmPassword' => "confirmPassword doesn't match",
            'brand' => "brand field required.",
            'price' => "price doesn't match type",
            'min' => "min field is less than minimum value",
            'max' => "max field is more than maximum value"

        ];
        $this->assertEquals($expectedArray,$validator->getErrors());
    }
}