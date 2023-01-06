<?php

namespace Clinicsys\Core\Contracts\Core;

interface  KernelContract{
    public function url():string;
    public function run():void ;
}
