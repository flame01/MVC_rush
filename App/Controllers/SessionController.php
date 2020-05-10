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
	public $userList = NULL;
	public $sessionUsername = NULL;

	public function __construct() {
		parent::__construct();
		$this->userList = $this->orm->select("User");

		if(!isset($_SESSION)){
			session_start();
		}

		$this->sessionUsername = $_SESSION["username"];
		if(empty($_SESSION["username"])){
			$this->sessionUsername = $_COOKIE['username'];
		} 
	}
}