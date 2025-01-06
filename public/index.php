<?php
require '../app/config.php';
require_once(__DIR__ . '/../app/Router.php');
require_once(__DIR__ . '/../app/controllers/UserController.php');

$router = new Router();

$router->add('/', 'UserController@index');
$router->add('/create', 'UserController@create');
$router->add('/user/@id', 'UserController@show');
$router->add('/edit/@id', 'UserController@edit');
$router->add('/delete/@id', 'UserController@delete');

$router->dispatch();