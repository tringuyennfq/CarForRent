<?php

namespace Test\Tringuyen\CarForRent\Model;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Model\Session;

class SessionTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function testGetSessID()
    {
        $sessionTest = new Session();
        $sessionTest->setsessID(1);
        $result = $sessionTest->getSessId();
        $this->assertEquals(1,$result);
    }

    public function testGetUserID()
    {
        $sessionTest = new Session();
        $sessionTest->setUserID(212);
        $result = $sessionTest->getUserID();
        $this->assertEquals(212,$result);
    }

    public function testGetSessLifetime()
    {
        $sessionTest = new Session();
        $sessionTest->setSessLifetime(time() + (60 * 60 * 24));
        $result = $sessionTest->getSessLifetime();
        $this->assertEquals(time() + (60 * 60 * 24),$result);
    }
}
