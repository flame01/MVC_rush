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
        $_SESSION["email"] = $result["email"];
        $_SESSION["group_id"] = $result["group_id"];
        //Check if Remember me is checked and create cookies.
        if(isset($remember)){
          setcookie("username", $_SESSION["username"], time()+3600);
          setcookie("email", $_SESSION["email"], time()+3600);
          setcookie("group_id", $_SESSION["group_id"], time()+3600);
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
        $session["username"] = $_SESSION["username"];
        $session["email"] = $_SESSION["email"];
        $session["group_id"] = $_SESSION["group_id"];

        //redirect to index
        $this->render('index.html.twig', ['base' => $request->base, 'userList' => $userList, 'sessionValues' => $session,'error' => $this->flashError]);

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
