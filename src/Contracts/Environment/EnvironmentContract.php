<?php
namespace Clinicsys\Core\Contracts\Environment;

interface EnvironmentContract{
    public static function Load():array;
    public static function GetEnv(string $EnvSection,  string $key):mixed;
}