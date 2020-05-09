<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** LogOutController.php
** File description:
**  This file is in charge of destroy the session and cookies.
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class LogOutController extends AppController {

  public function logout(Request $request) {
  	session_start();
	session_destroy();
	setcookie('username','', time()-3600);
    return $this->render('auth/login.html.twig', ['base' => $request->base, 'error' => $this->flashError]);
  }   
}
