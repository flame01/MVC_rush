<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** routes.php
** File description:
**  This file is in charge of continuosly check the browser address bar in order to redirect the user to the corresponding page.
**
*/
$router->use('GET', '', new App\Controllers\IndexController(), 'index_view');
$router->use('GET', 'index', new App\Controllers\IndexController(), 'index_view');

$router->use('GET', 'register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', 'register', new App\Controllers\AuthController(), 'register');

$router->use('GET', 'login', new App\Controllers\LoginController(), 'login_view');
$router->use('POST', 'login', new App\Controllers\LoginController(), 'login');

$router->use('GET', 'logout', new App\Controllers\LogOutController(), 'logout');

$router->use('GET', 'settings', new App\Controllers\UserSettingsController(), 'settings_view');
$router->use('POST', 'settings', new App\Controllers\UserSettingsController(), 'settings');