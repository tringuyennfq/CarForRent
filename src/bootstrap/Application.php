<?php

namespace Tringuyen\CarForRent\bootstrap;

class Application
{
    /**
     * @var Router
     */
    public Router $router;
    /**
     * @var Request
     */
    public Request $request;
    public static string $DIR_ROOT;
    public function __construct($path)
    {
        self::$DIR_ROOT=$path;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }
    public function run()
    {
        echo $this->router->resolve();
    }
}
