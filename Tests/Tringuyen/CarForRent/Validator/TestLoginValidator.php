<?php

namespace Test\Tringuyen\CarForRent\Validator;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Validator\LoginValidator;


class TestLoginValidator extends TestCase
{
    /**
     * @param $params
     * @param $expected
     * @dataProvider LoginValidatorDataProvider
     * @return void
     * @throws \Tringuyen\CarForRent\Exception\ValidationException
     */
    public function testLoginValidator($params, $expected)
    {
        $testLoginValidator = new LoginValidator();
        $result = $testLoginValidator->validateUserLogin($params['userRequest']);

        $this->assertEquals($expected, $result);
    }

    public function LoginValidatorDataProvider(): array
    {
        return [
            'case-1' => [
                'params' => [
                    'userRequest'=> new UserLoginRequest('khaitri', '123456')
                ],
                'expected'=> true
            ],
            'case-2' => [
                'params' => [
                    'userRequest'=> new UserLoginRequest('kasdas', '123456')
                ],
                'expected'=> true
            ],
            'case-3' => [
                'params' => [
                    'userRequest'=> new UserLoginRequest('', '123456')
                ],
                'expected'=> self::throwException($this->expectException('Username and password cannot be empty'))
            ]
        ];
    }


}