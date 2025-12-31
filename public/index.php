<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Define Routes
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/show', 'ShowController@index');

$router->dispatch();
