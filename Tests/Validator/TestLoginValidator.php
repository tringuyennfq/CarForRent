<?php

namespace Test\Validator;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\UserLoginRequest;
use Tringuyen\CarForRent\Validator\LoginValidator;
require '../../vendor/autoload.php';

class TestLoginValidator extends TestCase
{
    /**
     * @param $params
     * @param $expected
     * @dataProvider LoginValidatorDataProvider
     * @return void
     */
    public function TestLoginValidator($params, $expected)
    {
        $testLoginValidator = new LoginValidator();
        $result = $testLoginValidator->add($params['case-1']);

        $this->assertEquals($expected, $result);
    }

    public function LoginValidatorDataProvider(): array
    {
        return [
            'case-1' => [
                'params' => new UserLoginRequest('khaitri', '123456'),
                'expected'=> true
            ]
        ];
    }


}