<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class AuthController extends AppController {
  public function register_view(Request $request) {
    return $this->render('auth/register.html.twig', ['base' => $request->base,
      'error' => $this->flashError]);
  }

  public function checkIfExists(): boolean {
    $err = '';
    $userToInsert = $user->getUsername();
    $passwordToInsert = $user->getPassword();
    $emailToInsert = $user->getEmail();

    //$query = "SELECT user_id, username, email FROM User WHERE username = '$userToInsert' OR email = '$emailToInsert'";

    //$this->orm->persist($query);
    //this->orm->flush();

    //select($table, $values = "*", $condition = null, $multiple = true)
    $result = $this->orm->select("User", "user_id, username, email", "username = " . $userToInsert . " OR email = ".$emailToInsert."", false);

    if(is_null($result["user_id"])){
      return False;
    }else{
      if($userToInsert === $result["username"]){
        $err .= "User already exists.<br>";
      }

      if($emailToInsert === $result["email"]){
        $err .= "Email already used.<br>";
      }
      throw new \Exception($err);
    }
    return True;
  }


  public function register(Request $request) { 
    $user = new User();
    $user->setUsername($request->params['username']);
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);
    $user->setPasswordConfirmation($request->params['password_confirmation']);

    try {
      $user->validate();

      if (true){
        //$user->addToDB();

        var_dump($user);
        $userToInsert = $user->getUsername();
        $passwordToInsert = $user->getPassword();
        $emailToInsert = $user->getEmail();

        $query = "INSERT INTO User(username, password, email) VALUES ('$userToInsert', '$passwordToInsert', '$emailToInsert');";

        $this->orm->persist($query);
        $this->orm->flush();
        $this->redirect('/' . $request->base . 'login', '302');
      }
      
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'register', '302');
      return;
    }
  }


  
}
