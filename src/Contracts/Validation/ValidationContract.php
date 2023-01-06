<?php 
namespace Clinicsys\Core\Contracts\Validation;

interface ValidationContract{
    public static function TextField(string $text):bool; 
    public static function Password(string $password):bool; 
    public static function Email(string $email):bool; 
}