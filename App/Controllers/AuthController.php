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

  public function register(Request $request) { 
    $user = new User();
    $user->setUsername($request->params['username']);
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);

    try {
      $user->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'register', '302');
      return;
    }

    var_dump($user);

    $userToInsert = $user->getUsername();
    $passwordToInsert = $user->getPassword();
    $emailToInsert = $user->getEmail();

    $query = "INSERT INTO User(username, password, email) VALUES ('$userToInsert', '$passwordToInsert', '$emailToInsert');";

    $this->orm->persist($query);
    $this->orm->flush();

    // TODO: Store user in the database with the ORM (this->orm).
    $this->redirect('/' . $request->base . '', '302');
  }
}
