<?php

require_once 'Router.php';
require_once 'TestController.php';

$router = new Router();

// define routes
$router->get('/test', 'TestController@index');
$router->get('/test/hello', 'TestController@hello');
$router->get('/test/{name}', 'TestController@greet');

// run router
$router->dispatch();
