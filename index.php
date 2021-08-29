<?php 
session_start();

use \Core\{Config, Router, H};

//define constants 
define('PROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);


spl_autoload_register(function($className){
    $parts = explode('\\', $className);
    $class = end($parts);
    array_pop($parts);
    $path = strtolower(implode(DS, $parts));
    $path = PROOT . DS . $path . DS . $class . '.php';
    if(file_exists($path)) {
        include($path);
    }
});

$rootDir = Config::get('root_dir');
define('ROOT', $rootDir);

$url = $_SERVER['REQUEST_URI'];
$url = str_replace(ROOT, '', $url);
$url = preg_replace('/(\?.+)/', '', $url);
Router::route($url);
