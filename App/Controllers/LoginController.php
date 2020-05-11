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
    if ($this->session->get("username") === false) {
      return $this->render('auth/login.html.twig', ['base' => $request->base, 'error' => $this->flashError]);
    }else{
      $this->redirect('index', '302');
    }
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
        $this->session->set("user_id", $result["user_id"]);
        $this->session->set("username", $result["username"]);
        $this->session->set("email", $result["email"]);
        $this->session->set("group_id", $result["group_id"]);

        //Check if Remember me is checked and create cookies.
        if(isset($remember)){
          setcookie("user_id", $this->session->get("user_id"), time()+3600);
          setcookie("username", $this->session->get("username"), time()+3600);
          setcookie("email", $this->session->get("email"), time()+3600);
          setcookie("group_id", $this->session->get("group_id"), time()+3600);
        }
  			return true;
  		}
  	}
  }

  public function login(Request $request) {
    $userList = $this->orm->select("User");

  	// Obtain POST values of login.html.twig
  	$usernameEmail = $request->params['username-email'];
  	$password = $request->params['password'];
    $remember = $request->params['remember_me'];
    try{
    	if ($this->correctCredentials($usernameEmail, $password, $remember)){
        //redirect to index
        $this->redirect('index', '302');

    	}else{
    		$err = "Invalid credentials.<br>";
    		throw new \Exception($err);
    	}
    }catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('login', '302');
    }
  }
    
}
