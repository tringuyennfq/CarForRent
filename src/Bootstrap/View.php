<?php

namespace Tringuyen\CarForRent\Bootstrap;

class View
{

    /**
     * @param string $view
     * @param $params
     * @return array|string
     */
    public static function renderView(string $view, $params = []): array | string
    {
        $layoutContent = self::layoutContent();
        $viewContent = self::viewContent($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected static function layoutContent(): bool | string
    {
        ob_start();
        include_once __DIR__ . "/../View/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @param $params
     * @return bool|string
     */
    protected static function viewContent($view, $params): bool | string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/../View/$view.php";
        return ob_get_clean();
    }

    /**
     * @param $url
     * @return void
     */
    public static function redirect($url): void
    {
        header("Location: $url");
    }
}
