<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** AuthController.php
** File description:
**  This file is in charge of manage the data introduced/showed in register.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class AuthController extends AppController {
  public function register_view(Request $request) {
    // Render the register_view in auth/register.html.twig
    return $this->render('auth/register.html.twig', ['base' => $request->base,
      'error' => $this->flashError]);
  }

  public function userExists($userToInsert, $emailToInsert) {
    // Check if the user already exists in the database.

    // Call the function select in ORM.php file with the corresponding parameters.
    //select($table, $values = "*", $condition = null, $multiple = true);
    $result = $this->orm->select("User", "user_id, username, email", "username = '$userToInsert' OR email = '$emailToInsert'", false);

    // Check if we have any result.
    if(is_null($result["user_id"])){
      // If no username was returned it means that username and email specifieds are unique in the database.
      return false;
    }else{
      // If there is endeed a result it means username and/or email specified are already in the database.
      if($userToInsert === $result["username"]){
        $err .= "User already exists.<br>";
      }
      if($emailToInsert === $result["email"]){
        $err .= "Email already used.<br>";
      }
      throw new \Exception($err);
    }

  }

  public function addToDB($userToInsert, $emailToInsert, $passwordToInsert){
    //var_dump($user);
    $query = "INSERT INTO User(username, password, email) VALUES ('$userToInsert', '$passwordToInsert', '$emailToInsert');";

    $this->orm->persist($query);
    $this->orm->flush();
    //$this->redirect('/' . $request->base . 'login', '302');
  }


  public function register(Request $request) { 
    $user = new User();
    $user->setUsername($request->params['username']);
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);
    $user->setPasswordConfirmation($request->params['password_confirmation']);
    

    try {
      // Check that the data introduced meets the condicions.
      $user->validate();
      $userToInsert = $request->params['username'];
      $emailToInsert = $request->params['email'];
      $passwordToInsert = $request->params['password'];

      if(!$this->userExists($userToInsert, $emailToInsert)){
          // If the user does not exist we proceed to insert it to the database.
          $this->addtoDB($userToInsert, $emailToInsert, $passwordToInsert);
          $message = "User registered successfully";
          throw new \Exception($message);
      }
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'register', '302');
      return;
    }
  }
}
