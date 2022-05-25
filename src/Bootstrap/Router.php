<?php

namespace Tringuyen\CarForRent\Bootstrap;

use ReflectionException;

class Router
{
    public static array $routes = [];

    public function __construct()
    {
    }

    public static function get($path, $callback)
    {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['POST'][$path] = $callback;
    }


}
