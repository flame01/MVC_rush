<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** LoginController.php
** File description:
**  This file is in charge of manage the data introduced/showed in login.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class LoginController extends AppController {
  public function login_view(Request $request) {
    return $this->render('auth/login.html.twig', ['base' => $request->base, 'error' => $this->flashError]);
  }

  public function correctCredentials($usernameEmail, $password, $remember) {
    // Check if the user introduced exists in the database and if the password is correct.
  	$result = $this->orm->select("User", "*", "username = '$usernameEmail' OR email = '$usernameEmail'", false);

  	if(is_null($result["username"])){
  		// User not found.
  		return false;
  	}else{
  		// User found.
  		if($result["password"] === $password){
  			// Passwords match.
  			//Assign session values.
  			session_start();
  			$_SESSION["user_id"] = $result["user_id"];
  			$_SESSION["username"] = $result["username"];
        if(isset($remember)){
          setcookie("username", $_SESSION["username"], time()+3600);
        }
  			return true;
  		}
  	}


  }

  public function login(Request $request) {
  	// Obtain POST values of login.html.twig
  	$usernameEmail = $request->params['username-email'];
  	$password = $request->params['password'];
    $remember = $request->params['remember_me'];

  	if ($this->correctCredentials($usernameEmail, $password, $remember)){

  		//Check if Remember me is checked and create cookies.

      //redirect to index
      var_dump($remember);
      //return $this->render('index', ['base' => $request->base, 'error' => $this->flashError]);
  	}else{
  		$err = "Invalid credentials.<br>";
  		var_dump($err);
  		throw new \Exception($err);
  	}
  }
    
}
