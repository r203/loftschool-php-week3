<?php
require './vendor/autoload.php';
require './Base/config.php';

$route = new \Base\Route();
$route->add('/', \App\Controller\Login::class);
// $route->add('/register', \App\Controller\Login::class);

$app = new \Base\Application($route);
$app->run();