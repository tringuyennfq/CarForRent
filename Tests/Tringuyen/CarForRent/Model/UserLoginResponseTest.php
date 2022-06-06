<?php

namespace Test\Tringuyen\CarForRent\Model;


use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Model\UserLoginResponse;

class UserLoginResponseTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testGetUser(): void
    {
        $userLoginResponseTest = new UserLoginResponse();
        $userTest = new User();
        $userLoginResponseTest->setUser($userTest);
        $result = $userLoginResponseTest->getUser();
        $expected = $userTest;
        $this->assertEquals($expected, $result);
    }
}
