<?php

namespace Tringuyen\CarForRent\bootstrap;

class Router
{
    public static Request $request;
    public static Response $response;
    protected static array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        self::$request = $request;
        self::$response = $response;
    }

    public static function get($path, $callback)
    {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['POST'][$path] = $callback;
    }

    public static function resolve()
    {
        $path = self::$request->getPath();
        $method = self::$request->getMethod();
        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            self::$response->setStatusCode(404);
            return View::renderView('404');
        }
        if (is_string($callback)) {
            return View::renderView($callback);
        }
        return call_user_func($callback);
    }

}
