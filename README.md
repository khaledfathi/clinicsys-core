# Clinicsys-Core 
```diff
- This is just programming task from *EraaSoft_Learning_Center_Task* 
```
---


Dependency for Clinicsys Application 

Features
------------
* Routes Managment 
* MySQL API
* Config From External Env File
* Bultin URI managment (Paths , URLs and Redirect)
* Bultin Validation functions (Text , Password , Email)



Installation
------------

The preferred way to install this extension is through [composer ](https://getcomposer.org/).

run from your Terminal 

```
composer require clinicsys/core
```

Usage
-----
add ```env.json``` into your root directory
add these configuration , change it as your system require
```
{
    "DATABASE":{
        "HOST": "localhost",
        "USER": "root",
        "PASSWORD": "",
        "DATABASE": "db",
        "PORT":3306
    },
    "VALIDATION":{
        "TEXT_FIELD_REQUIRE":true,
        "TEXT_MIN_LENGTH":3,
        "TEXT_MAX_LENGTH":20,
        "PASSWORD_MIN_LENGTH": 8, 
        "PASSWORD_MAX_LENGTH": 20
    }
}
```
to use Whoops add to your ```index.php``` add :
```
<?php
require('vendor/autoload.php');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

```
for creating routes :
```
Route::Get('/' , ['Controller' , 'method' ], ['arg1','arg2']);
```
1st parameter = the request URI

2nd parameter = Controller is your target class name and method is the method you want to run 

3ed parameter = the arguments you want to pass into method 
