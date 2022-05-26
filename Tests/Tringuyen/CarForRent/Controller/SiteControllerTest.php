<?php

namespace Test\Tringuyen\CarForRent\Controller;

use PHPUnit\Framework\TestCase;
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
        $this->assertNotNull($result);
    }
}
