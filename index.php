<?php

require_once 'includes/functions.php';
require_once base_path() . '/vendor/autoload.php';
use Core\Router;

spl_autoload_register(function (string $class_name) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

    $file = base_path() . "$class.php";
    require $file;
});

$router = new Router();

require 'router/api.php';

try {
    echo($router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']));
} catch (Exception $exception) {
    echo 'Failure: ' . $exception;
}


