<?php
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/AuthController.php';
require_once 'src/controllers/PostController.php';
class Routing
{
    public static $routes;

    public static function get($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run($url)
    {
        $arguments = explode("/", $url);
        $action = $arguments[0];
        $action = $action ?: 'index';
        unset($arguments[0]);

        if (preg_match('#^post/(\d+)$#', $url, $matches)) {
            $action = 'post';
            $arguments = [$matches[1]];
        }

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller();

        if (empty($arguments)) {
            $object->$action();
        } else {
            $object->$action($arguments);
        }
    }

}