<?php

namespace Clinicsys\Core\Core;
use Clinicsys\Core\Contracts\Core\KernelContract; 
use Clinicsys\Core\Core\Route;
use Exception;

class Kernel implements KernelContract{

    private $controller;

    private $method;

    private $args; 

    public function url():string{
        return $_SERVER['QUERY_STRING'];
    }

    public function run():void{
       if(array_key_exists($this->url(),Route::$routes)){
        
        $this->controller = Route::$routes[$this->url()][0];
        $this->method = Route::$routes[$this->url()][1];
        $this->args = Route::$routes[$this->url()][2];
        
        call_user_func_array([new $this->controller,$this->method],$this->args);
  
    }else{
        throw new Exception("controller not found");
       }
    }
}

