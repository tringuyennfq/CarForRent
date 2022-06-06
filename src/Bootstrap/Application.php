<?php

namespace Tringuyen\CarForRent\Bootstrap;

use ReflectionException;
use Tringuyen\CarForRent\Http\Request;
use Tringuyen\CarForRent\Http\Response;

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

    public function __construct(string $rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router();
    }

    /**
     * @throws ReflectionException
     */
    public function run()
    {
         echo $this->resolve();
    }

    /**
     * @throws ReflectionException
     */
    public function resolve()
    {
        $container = new Container();
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = Router::$routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return View::renderView('404');
        }
        if (is_string($callback)) {
            return View::renderView($callback);
        }
        $currentController = $callback[0];
        $action = $callback[1];

        $controller = $container->make($currentController);
        return $controller->$action();
    }
}
