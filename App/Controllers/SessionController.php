<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** SessionController.php
** File description:
**  This file is in charge of manage the session data.
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class SessionController extends AppController{
	public function __construct() {
		$userList = $this->orm->select("User");
  		session_start();

  		$sessionUsername = $_SESSION["username"];
  		if(empty($_SESSION["username"])){
  			$sessionUsername = $_COOKIE['username'];
  		}
	}
}