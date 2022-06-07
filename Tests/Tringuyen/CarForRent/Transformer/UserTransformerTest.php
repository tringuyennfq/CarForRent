<?php

namespace Test\Tringuyen\CarForRent\Transformer;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\User;
use Tringuyen\CarForRent\Tranformer\UserTranformer;

class UserTransformerTest extends TestCase
{
    public function testUserToArray()
    {
        $user = new User();
        $user->setId(1);
        $user->setUsername('khatri');

        $testUserTransformer = new UserTranformer();
        $resultArray = $testUserTransformer->userToArray($user);
        $expectedArray = [
            'id' => $user->getId(),
            'username' => $user->getUsername()
        ];
        $this->assertEquals($expectedArray, $resultArray);
    }
}
