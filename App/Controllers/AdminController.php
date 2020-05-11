<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** AdminController.php
** File description:
**  This file is in charge of manage the data introduced/showed in index.html.twig
**
*/
namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\User;

class AdminController extends AppController{

  public function admin_view(Request $request){
    $userList = $this->orm->select("User");

    if ($this->session->get("group_id") === '0') {
      // Render the admin_view in admin.html.twig
      return $this->render('admin.html.twig', ['base' => $request->base, 'userList' => $userList, 'session' => $this->session]);
    }else{
      $this->redirect('index', '302');
    }
  }

  public function admin_delete(Request $request){
    
    $usernameToDelete = $request->params['usernameToDelete'];
    $result = $this->orm->delete("User", "username = '$usernameToDelete'");
      var_dump($usernameToDelete);
    if($result == 1){
      $success = true;
      $message = "The account has been deleted";
    } else{
      $success = false;
      $message = "Unknown error when trying to delete your account.";
    }
      
    echo json_encode([
        "success" => $success,
        "message" => $message
    ]);
  } 
}