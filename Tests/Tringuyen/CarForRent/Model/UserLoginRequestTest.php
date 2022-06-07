<?php

namespace Test\Tringuyen\CarForRent\Model;


use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Transfer\UserLoginRequest;

class UserLoginRequestTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testFromArray()
    {
        $array = [
            'username'=>'khaitri',
            'password'=>'asd'
        ];
        $userLoginRequestTest = new UserLoginRequest();
        $result = $userLoginRequestTest->fromArray($array);
        $expected = new UserLoginRequest();
        $expected->setUsername('khaitri');
        $expected->setPassword('asd');
        $this->assertEquals($expected, $result);
    }
}
