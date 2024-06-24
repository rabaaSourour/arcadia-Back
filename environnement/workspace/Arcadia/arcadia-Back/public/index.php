<?php
use Router\Router;

require '../vendor/autoload.php';

$url = $_GET['url'] ?? '/';

$router = new Router($url);

$router->get('/','BlogController@index');
$router->get('/posts/:id','App\Controllers\BlogController@shox');

$router->run();