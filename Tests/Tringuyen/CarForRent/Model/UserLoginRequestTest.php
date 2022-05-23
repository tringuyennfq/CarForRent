<?php

namespace Test\Tringuyen\CarForRent\Model;


use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Bootstrap\Request;
use Tringuyen\CarForRent\Model\UserLoginRequest;

class UserLoginRequestTest extends TestCase
{
    /**
     * @return void
     */
    public function testFromArray()
    {
        $mockRequest = $this->createMock(Request::class);
        $array = [
            'username'=>'khaitri',
            'password'=>'asd'
        ];
        $mockRequest->method("getBody")->willReturn($array);
        $mockRequest->method("getMethod")->willReturn('POST');
        $userLoginRequestTest = new UserLoginRequest();
        $result = $userLoginRequestTest->fromArray();
        $expected = new UserLoginRequest();
        $expected->setUsername('khaitri');
        $expected->setPassword('asd');
        $this->assertEquals($expected, $result);
    }
}
