<?php

namespace Test\Tringuyen\CarForRent\Service;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Service\CookieService;

class CookieServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testSet(): void
    {
        $cookie = $this->getMockBuilder(CookieService::class)->getMock();
        $cookie->expects($this->once())->method('set')->willReturn(true);
        $this->assertTrue($cookie->set("cookie-name","cookie-value"));
    }
}