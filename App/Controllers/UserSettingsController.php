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

class UserSettingsController extends AppController {
  public function settings_view(Request $request) {

    if ($this->session->get("username") !== false) {
      $userList = $this->orm->select("User");
      
      // Render the settings_view in userSettings.html.twig
      return $this->render('userSettings.html.twig', ['base' => $request->base, 'userList' => $userList, 'session' => $this->session, 'error' => $this->flashError]);
    }else{
      $this->redirect('index', '302');
    }
    
  }

  public function correctCredentials($username, $password, $passwordConfirmation) {
    $err = '';
    // Check if the user introduced exists in the database and if the password is correct.
    $result = $this->orm->select("User", "*", "WHERE username = '$username'", false);

    if (empty($password) || empty($passwordConfirmation)) {
      $err = $err . "Both password fields must be filled.<br>";

    }elseif($password !== $passwordConfirmation) {
      $err = $err . "Both password fields must coincide.<br>";

    }elseif ($password !== $result["password"]) {
        $err = $err . "Incorrect password.<br>";
    }
    if($err !== ''){
      throw new \Exception($err);
      return false;
    }
    return true;
  }

  public function deleteAccount(Request $request) {
    try{
      if($this->correctCredentials($session->sessionUsername, $request->params['password'], $request->params['passwordConfirm'])){

        $usernameToDelete = $session->sessionUsername;
        $result = $this->orm->delete("User", "username = '$usernameToDelete'");
        if($result == 1){
            $message = "The account has been deleted";
        }else{
            $err = "Unknown error when trying to delete your account.";
        }
        
        $this->flashError->set($message);
        //Logout session after deleting the user.
        $this->redirect('logout', '302');
      }

    }catch(\Exception $e){
        $this->flashError->set($e->getMessage());
        $this->redirect('settings', '302');
    }
  }
}
