<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\User;

class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetId(): void
    {
        $user1 = new User();
        $user1->setId(12);
        $result = $user1->getId();
        $this->assertEquals(12, $result);
    }

    /**
     * @return void
     */
    public function testGetUsername(): void
    {
        $user1 = new User();
        $user1->setUsername('aloalo');
        $result = $user1->getUsername();
        $this->assertEquals('aloalo', $result);
    }

    /**
     * @return void
     */
    public function testGetPassword(): void
    {
        $user1 = new User();
        $user1->setPassword('123456');
        $result = $user1->getPassword();
        $this->assertEquals('123456', $result);
    }
}