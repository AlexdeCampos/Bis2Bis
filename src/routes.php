<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@signupAction');

$router->get('/post/{id}/delete', 'PostController@delete');

$router->get('/perfil/{id}', 'ProfileController@index');
$router->get('/perfil', 'ProfileController@index');

$router->get('/sair', 'LoginController@logout');

$router->get('/ajax/like/{id}', 'AjaxController@like');
$router->post('/ajax/newPost', 'AjaxController@newPost');