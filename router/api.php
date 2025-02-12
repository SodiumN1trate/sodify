<?php

global $router;

$router->get('/test', [\Controller\TestController::class, 'test']);

$router->get('/ping', [\Controller\TestController::class, 'ping']);