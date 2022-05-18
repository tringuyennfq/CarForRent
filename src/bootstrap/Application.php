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
    /**
     * @var string
     */
    public static string $ROOT_DIR;
    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Application
     */
    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
