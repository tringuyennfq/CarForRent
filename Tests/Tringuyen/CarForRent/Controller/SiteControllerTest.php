<?php

namespace Test\Tringuyen\CarForRent\Controller;

use PHPUnit\Framework\TestCase;
use Tringuyen\CarForRent\Bootstrap\View;
use Tringuyen\CarForRent\Controller\SiteController;

class SiteControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testHome()
    {
        $controllerTest = new SiteController();
        $result = $controllerTest->home();
        $params = [
            'name' => "Tri Nguyen"
        ];
        $expected = View::renderView('home', $params);
        $this->assertEquals($expected,$result);
    }
}
