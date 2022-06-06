<?php

namespace Test\Tringuyen\CarForRent\Validator;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Model\UserRegisterRequest;
use Tringuyen\CarForRent\Repository\UserRepository;
use Tringuyen\CarForRent\Validator\RegisterValidator;

class RegisterValidatorTest extends TestCase
{
    public function testValidateUserRegisterSuccess()
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUsername')->willReturn(null);
        $userRegisterRequest = new UserRegisterRequest();
        $userRegisterRequest->setSelf('khaitri','123123','123123');
        $userRegisterValidator = new RegisterValidator($userRepositoryMock);
        $result = $userRegisterValidator->validateUserRegister($userRegisterRequest);
        $this->assertTrue($result);
    }
    public function testValidateUserRegisterExistsUsername()
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUsername')->willReturn(new User());
        $userRegisterRequest = new UserRegisterRequest();
        $userRegisterRequest->setSelf('khaitri','123123','123123');
        $userRegisterValidator = new RegisterValidator($userRepositoryMock);
        $result = $userRegisterValidator->validateUserRegister($userRegisterRequest);
        $expectedError = [
            'username'=>'Username already exists!'
        ];
        $this->assertEquals($expectedError,$result);
    }

}