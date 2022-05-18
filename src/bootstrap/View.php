<?php

namespace Tringuyen\CarForRent\bootstrap;

class View
{

    public static function renderView(string $view, $params = [])
    {
        $layoutContent = self::layoutContent();
        $viewContent = self::viewContent($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);


    }

    protected static function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/src/view/layouts/main.php";
        return ob_get_clean();
    }

    protected static function viewContent($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/src/view/$view.php";
        return ob_get_clean();
    }
}
