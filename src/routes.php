<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

/*
* rotas para testar o funcionamento do mvc da b7web 
*
*
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/fotos', 'HomeController@fotos');
$router->get('/foto/{id}', 'HomeController@foto');
$router->get('/foto', 'HomeController@foto');
*
*
*
*/