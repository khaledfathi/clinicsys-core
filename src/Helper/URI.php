<?php
use Clinicsys\Core\Environment\Env; 

function path(string $relativePath , string $rootPath='/'): string{
    $relativePath = "/" . ltrim($relativePath,'/'); 
    if (!preg_match('/^\//i',$rootPath)){
        throw new Exception('root path is not valid! - it should start with "/"'); 
    }
    preg_match('/^\/\w+/i',$_SERVER['REQUEST_URI'],$matchs); 
    return $_SERVER['DOCUMENT_ROOT'].$matchs[0].rtrim($rootPath,'/').$relativePath  ; 
}

function url (string $relativeURI,$port=false , string $rootUrl='/'):string {
    $relativeURI = "/" . ltrim($relativeURI, '/'); 
    if (!preg_match('/^\//i',$rootUrl)){
        throw new Exception(' root URI is not valid! - it should start with "/"');
    }else if (!preg_match('/^\/.+/i' , $rootUrl)){
        $rootUrl = trim($rootUrl, '/'); 
    }
    $rootUrl = rtrim($rootUrl, '/');
    $url = $_SERVER['REQUEST_SCHEME'] ."://".$_SERVER['SERVER_NAME'] .":". $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    $matches = [];
    if ($port) {
        preg_match('/^\w+:\/\/[^\/]+\/[^\/]+/i',$url,$matches);
        return $matches[0].$rootUrl.$relativeURI; 
    }
    preg_match('/(^\w+:\/\/[^:]+):\d+(\/[^\/]+)/i',$url,$matches); 
    return $matches[1].$matches[2].$rootUrl.$relativeURI; 
}

function redirect(string $url): void {
    header("location: " . $url);
    die;  
}