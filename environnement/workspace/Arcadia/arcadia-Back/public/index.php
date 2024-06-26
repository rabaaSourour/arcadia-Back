<?php


use Router\Router;

require '../vendor/autoload.php';

$url = $_GET['url'] ?? '/';

$router = new Router($url);

$router->get('/', 'App\Controllers\ArcadiaController@index');
$router->get('/posts/:id', 'App\Controllers\ArcadiaController@show');
$router->get('/posts', 'App\Controllers\ArcadiaController@list');
$router->get('/posts/create', 'App\Controllers\ArcadiaController@create');
$router->post('/posts/store', 'App\Controllers\ArcadiaController@store');
$router->get('/posts/:id/edit', 'App\Controllers\ArcadiaController@edit');
$router->post('/posts/:id/update', 'App\Controllers\ArcadiaController@update');
$router->post('/posts/:id/delete', 'App\Controllers\ArcadiaController@delete');

$router->run();