<?php

namespace Test\Tringuyen\CarForRent\Validator;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Exception\ValidationException;
use Tringuyen\CarForRent\Transfer\UserLoginRequest;
use Tringuyen\CarForRent\Validator\LoginValidator;

class LoginValidatorTest extends TestCase
{

    /**
     * @param $params
     * @param $expected
     * @dataProvider LoginValidatorSuccessDataProvider
     * @return void
     * @throws ValidationException
     */
    public function testLoginValidatorSuccess($params, $expected): void
    {
        $testLoginValidator = new LoginValidator();
        $result = $testLoginValidator->validateUserLogin($params['userRequest']);

        $this->assertEquals($expected, $result);
    }

    #[ArrayShape(['case-1' => "array", 'case-2' => "array", 'case-3' => "array"])] public function LoginValidatorSuccessDataProvider(): array
    {
        $request1 = new UserLoginRequest();
        $request1->setUsername('khaitri');
        $request1->setPassword('123');
        $request2 = new UserLoginRequest();
        $request2->setUsername('hoaito');
        $request2->setPassword('1aaa');
        $request3 = new UserLoginRequest();
        $request3->setUsername('minhkha');
        $request3->setPassword('1aaa11');
        return [
            'case-1' => [
                'params' => [
                    'userRequest'=> $request1
                ],
                'expected'=> true
            ],
            'case-2' => [
                'params' => [
                    'userRequest'=> $request2
                ],
                'expected'=> true
            ],
            'case-3' => [
                'params' => [
                    'userRequest'=> $request3
                ],
                'expected'=> true
            ]
        ];
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function testLoginValidatorFailed(): void
    {
        $testLoginValidator = new LoginValidator();

        $request1 = new UserLoginRequest();
        $request1->setUsername('');
        $request1->setPassword('123');
        $this->expectException(exception: ValidationException::class);

        $testLoginValidator->validateUserLogin($request1);
    }
}
