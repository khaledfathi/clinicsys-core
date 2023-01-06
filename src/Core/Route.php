<?php
namespace Clinicsys\Core\Core;

use Clinicsys\Core\Core\Kernel;

class Route
{
    public static $routes;
    public static function Get(string $url, array $action , array $args=[]):void 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::$routes[$url] = $action;
            self::$routes[$url][] = $args;
            (new kernel)->run(); 
        }
    }
    public static function Post(string $url, array $action ,array $args=[]): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::$routes[$url] = $action;
            self::$routes[$url][] = $args;
            (new kernel)->run(); 
        }
    }
}

