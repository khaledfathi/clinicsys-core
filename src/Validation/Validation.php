<?php
namespace Clinicsys\Core\Validation; 
use Clinicsys\Core\Contracts\Validation\ValidationContract;
use Clinicsys\Core\Environment\Env; 

class Validation implements ValidationContract{
    public static function TextField(string $text): bool{
        $text = trim($text); 
        $require = Env::getEnv('VALIDATION','TEXT_FIELD_REQUIRE'); 
        $minLength = Env::getEnv('VALIDATION','TEXT_MIN_LENGTH'); 
        $maxLength = Env::getEnv('VALIDATION','TEXT_MAX_LENGTH');
        if (!$require)
            return true;
        return preg_match("/^.{".$minLength.",".$maxLength."}(?!.)/i", $text); 
    }
    public static function Password(string $password):bool{
        $minLength = Env::getEnv('VALIDATION','PASSWORD_MIN_LENGTH'); 
        $maxLength = Env::getEnv('VALIDATION','PASSWORD_MAX_LENGTH');
        return preg_match("/^.{".$minLength.",".$maxLength."}(?!.)/i", $password); 
    }
    public static function Email(string $email):bool{
        return filter_var($email, FILTER_VALIDATE_EMAIL); 
    }
}