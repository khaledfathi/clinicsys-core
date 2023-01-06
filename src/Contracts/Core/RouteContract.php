<?php
namespace Clinicsys\Core\Contracts\Core;
interface RouteContract{
    public static function Get(string $url, array $action , array $args=[]):void;  
    public static function Post(string $url, array $action ,array $args=[]): void; 
}

