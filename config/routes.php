<?php

//Next line no working
//$router->use('GET', '/auth/register', new App\Controllers\AuthController(), 'register_view');
//Netx line working
$router->use('GET', 'register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', 'register', new App\Controllers\AuthController(), 'register');
$router->use('GET', '', new App\Controllers\IndexController(), 'index');
$router->use('GET', 'login', new App\Controllers\LoginController(), 'login_view');
//$router->use('POST', 'login', new App\Controllers\LoginController(), 'login');