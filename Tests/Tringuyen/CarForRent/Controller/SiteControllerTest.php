<?php

namespace Test\Tringuyen\CarForRent\Controller;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Controller\SiteController;
use Tringuyen\CarForRent\Service\CarService;

class SiteControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testHome()
    {
        $carServiceMock = $this->getMockBuilder(CarService::class)->disableOriginalConstructor()->getMock();
        $carServiceMock->expects($this->once())->method('getAll')->willReturn([]);
        $controllerTest = new SiteController($carServiceMock);
        $result = $controllerTest->home();
        $expected  = View::renderView('home',[]);
        $this->assertEquals($expected,$result);
    }
}
