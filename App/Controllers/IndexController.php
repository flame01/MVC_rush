<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** IndexController.php
** File description:
**  This file is in charge of manage the data introduced/showed in index.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class IndexController extends AppController{
  public function index_view(Request $request){

      $userList = $this->orm->select("User");
      session_start();

      $session["username"] = $_SESSION["username"];
      $session["email"] = $_SESSION["email"];
      $session["group_id"] = $_SESSION["group_id"];

      if(empty($_SESSION["username"])){
        $session["username"] = $_SESSION["username"];
        $session["email"] = $_SESSION["email"];
        $session["group_id"] = $_SESSION["group_id"];
      }
  
    // Render the index_view in index.html.twig
  	return $this->render('index.html.twig', ['base' => $request->base, 'userList' => $userList, 'sessionValues' => $session]);
  }
  
}