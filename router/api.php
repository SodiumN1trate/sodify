<?php

global $router;

$router->get('/test', [\Controller\TestController::class, 'test']);
$router->get('/ping', [\Controller\TestController::class, 'ping']);
$router->post('/test', [\Controller\TestController::class, 'create']);