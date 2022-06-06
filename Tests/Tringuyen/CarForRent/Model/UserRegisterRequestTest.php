<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\UserRegisterRequest;

class UserRegisterRequestTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function testGetSet(): void
    {
        $resultUserRegisterRequest = new UserRegisterRequest();
        $resultUserRegisterRequest->setSelf('khaitri','123123','123123');
        $expectedUserRegisterRequest = new UserRegisterRequest();
        $expectedUserRegisterRequest->setUsername('khaitri');
        $expectedUserRegisterRequest->setPassword('123123');
        $expectedUserRegisterRequest->setConfirmPassword('123123');
        $expectedUserRegisterRequest->setHashPassword($expectedUserRegisterRequest->hashPassword($expectedUserRegisterRequest->getPassword(),PASSWORD_BCRYPT));

        $this->assertEquals($expectedUserRegisterRequest->getUsername(),$resultUserRegisterRequest->getUsername());
        $this->assertEquals($expectedUserRegisterRequest->getPassword(),$resultUserRegisterRequest->getPassword());
        $this->assertEquals($expectedUserRegisterRequest->getConfirmPassword(),$resultUserRegisterRequest->getConfirmPassword());
        $this->assertEquals(password_verify($expectedUserRegisterRequest->getPassword(),$expectedUserRegisterRequest->getHashPassword()),password_verify($resultUserRegisterRequest->getPassword(),$resultUserRegisterRequest->getHashPassword()));
    }

    public function testFromArray()
    {
        $testArray = [
            'username' => 'khaitri',
            'password' => '123123',
            'confirmPassword' => '123123'
        ];
        $resultUserRegisterRequest = new UserRegisterRequest();
        $resultUserRegisterRequest->fromArray($testArray);
        $expectedUserRegisterRequest = new UserRegisterRequest();
        $expectedUserRegisterRequest->setSelf($testArray['username'],$testArray['password'],$testArray['confirmPassword']);
        $this->assertEquals($expectedUserRegisterRequest->getUsername(),$resultUserRegisterRequest->getUsername());
        $this->assertEquals($expectedUserRegisterRequest->getPassword(),$resultUserRegisterRequest->getPassword());
        $this->assertEquals($expectedUserRegisterRequest->getConfirmPassword(),$resultUserRegisterRequest->getConfirmPassword());
        $this->assertEquals(password_verify($expectedUserRegisterRequest->getPassword(),$expectedUserRegisterRequest->getHashPassword()),password_verify($resultUserRegisterRequest->getPassword(),$resultUserRegisterRequest->getHashPassword()));
    }
}