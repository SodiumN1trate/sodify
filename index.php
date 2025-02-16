<?php

require_once 'includes/functions.php';
require_once base_path() . '/vendor/autoload.php';

/*
 * Create autoloader
 */
spl_autoload_register(function (string $class_name) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

    $file = base_path() . "$class.php";
    require $file;
});

/*
 * Load .env
 */
$dotenv = \Dotenv\Dotenv::createImmutable(base_path());
$dotenv->load();


/*
 * Add router and import defined routes
 */
use Core\Router;
$router = new Router();
require 'router/api.php';

//$query->execute();
//$query->setFetchMode(\PDO::FETCH_ASSOC);
//dd($query->fetchAll());

try {
    // Show response from controller
    echo($router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], json_decode(file_get_contents('php://input'))));
} catch (Exception $exception) {
    echo 'Failure: ' . $exception;
}


